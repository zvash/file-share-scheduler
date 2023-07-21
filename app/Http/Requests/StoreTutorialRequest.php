<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTutorialRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'download_url' => ['required', 'active_url'],
            'thumbnail_url' => ['sometimes', 'nullable', 'active_url'],
            'google_drive' => ['boolean'],
            'size' => ['sometimes', 'nullable']
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->google_drive) {
            $this->prepareGoogleDriveDownloadLink('download_url');
            $this->prepareGoogleDriveDownloadLink('thumbnail_url');
        }
    }

    private function prepareGoogleDriveDownloadLink($attribute)
    {
        if ($this->$attribute) {
            $urlParts = explode('/', $this->$attribute);
            $size = count($urlParts);
            if (array_key_exists($size - 2, $urlParts)) {
                $this->merge([
                    $attribute => "https://drive.google.com/uc?export=download&id={$urlParts[$size - 2]}"
                ]);
                if ($attribute == 'download_url') {
                    $size = $this->getRemoteFileSize("https://drive.google.com/uc?export=download&id={$urlParts[$size - 2]}");
                    $this->merge([
                        'size' => $size
                    ]);
                }
            }
        }
    }

    private function getRemoteFileSize($url)
    {
        $fileSize = 0;
        $headers = get_headers($url, 1);
        if (isset($headers["Content-Length"])) {
            if (!is_array($headers["Content-Length"])) {
                $fileSize = max($fileSize,
                    is_numeric($headers["Content-Length"]) ? $headers["Content-Length"] * 1 : 0);
            } else {
                foreach ($headers["Content-Length"] as $size) {
                    $fileSize = max($fileSize,
                        is_numeric($size) ? $size * 1 : 0);
                }
            }

        }
        return $this->humanFileSize($fileSize);
    }

    private function humanFileSize($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . ' ' . @$sz[$factor] . 'B';
    }
}
