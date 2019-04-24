<?php

namespace App\Admin\Services\MediaLibrary;

use URL;

trait MediaLibrary
{
    private $responsive = false;

    public function responsive()
    {
        $this->responsive = true;

        return $this;
    }

    public function objectUrl($mediaId)
    {
        return URL::route('admin.media.download', $mediaId);
    }

    public function getMimeType(string $mime): string
    {
        switch ($mime) {
            case 'image/jpeg':
            case 'image/png':
                $type = 'image';
                break;
            case 'application/pdf':
                $type = 'pdf';
                break;
            case 'text/plain':
                $type = 'text';
                break;
            case 'application/msword':
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            case 'application/vnd.ms-excel':
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            case 'application/vnd.ms-powerpoint':
            case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
                $type = 'office';
                break;
            case 'image/tiff':
                $type = 'gdocs';
                break;
            case 'text/html':
                $type = 'html';
                break;
            case 'video/mp4':
            case 'application/mp4':
            case 'video/x-sgi-movie':
                $type = 'video';
                break;
            case 'audio/mpeg':
            case 'audio/mp3':
                $type = 'audio';
                break;

            default:
                $type = 'image';
        }

        return $type;
    }
}
