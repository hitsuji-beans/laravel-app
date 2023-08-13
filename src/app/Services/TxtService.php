<?php
namespace App\Services;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Stringable;

class TxtService implements FilesystemInterface
{
    /**
     * ファイルに書き込む
     *
     * @param mixed $data 書き込み内容
     * @return void
     */
    public function write(mixed $data, $header)
    {
        $stream = $this->open();

        $this->filterStream($stream);

        foreach ($this->splitAsStringArray(collect($data)) as $row) {
            $this->writeRow($stream, $row);
        }

        $this->close($stream);
    }

    /**
     * ストリームを開く
     *
     * @param string $filename
     * @param string $mode
     * @return resource
     */
    public function open(string $filename = 'php://output', string $mode = 'w')
    {
        // 出力バッファをopen（できなければエラー）
        return throw_unless(
            fopen($filename, $mode),
            \Exception::class,
            'ストリームを開くことができませんでした。'
        );
    }

    /**
     * ストリームを閉じる
     *
     * @param resource $stream
     * @return void
     */
    public function close($stream)
    {
        fclose($stream);
    }

    /**
     * ストリームにフィルター付加
     *
     * @param resource $stream ストリーム
     * @param string $filtername フィルタ名
     * @return void
     */
    public function filterStream($stream, string $filtername = 'convert.iconv.utf-8/cp932//TRANSLIT')
    {
        // 文字コードを変換して、文字化け回避
        stream_filter_prepend($stream, $filtername);
    }

    /**
     * データ書き込み（行）
     *
     * @param mixed $stream ストリーム
     * @param mixed $data 書き込むデータ
     * @return void
     */
    public function writeRow($stream, mixed $data)
    {
        // データの挿入（改行付き）
        fputs($stream, "{$data}.\r\n");
    }

    /**
     * CSVに書き込んでダウンロードするレスポンス返却
     *
     * @param mixed $records 出力対象レコード
     * @param string $filename ファイル名
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function downloadResponse(mixed $data, string $filename = 'sample.txt', $header = null)
    {
        return response()->streamDownload(
            fn () => $this->write($data, $header),
            $filename,
            ['Content-Type' => 'application/octet-stream']
        );
    }

    /**
     * 書き込みデータの配列化
     *
     * @param mixed $data 書き込みデータ
     * @return array
     */
    public function toArray($data)
    {
        // 配列化可能ならば配列化（CollectionやModelの許可）
        if ($data instanceof Arrayable) {
            $data = $data->toArray();
        }

        // 配列でない場合はエラー
        throw_if(!is_array($data), \Exception::class, 'CSVへの書き込み行が配列ではありません。');

        return $data;
    }

    /**
     * 渡されたデータのArray<string>化
     *
     * @param \Illuminate\Support\Collection $collection 書き込みデータのコレクションラップ
     * @param string $separator デリミタ
     * @return array<string>
     */
    public function splitAsStringArray(Collection $collection, string $separator = ',')
    {
        $split = [];

        foreach ($collection as $data) {
            // 文字列の場合、改行コードで分割
            if (is_string($data) || $data instanceof Stringable) {
                foreach (preg_split('/(\r\n|\r|\n)/', (string) $data) as $str) {
                    $split[] = $str;
                };
                continue;
            }

            // 配列の場合、カンマで区切って文字列に変換する
            if (is_array($data) || $data instanceof Arrayable) {
                $split[] = implode($separator, (array) $data);
                continue;
            }

            throw new \Exception('文字列に変換できませんでした。');
        }

        return $split;
    }
}