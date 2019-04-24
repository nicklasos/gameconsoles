<?php

namespace App\Admin\Services\MediaLibrary;

use Encore\Admin\Form\Field\MultipleFile;
use Encore\Admin\Form\NestedForm;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaLibraryMultipleFile extends MultipleFile
{
    use MediaLibrary;

    protected $view = 'admin::form.multiplefile';

    public function fill($data)
    {
        parent::fill($data);

        $value = $this->form->model()->getMedia($this->column());

        foreach ($value as $key => $media) {
            $this->value[$key] = $media->id;
        }
    }

    /**
     * Set original value to the field.
     *
     * @param array $data
     *
     * @return void
     */
    public function setOriginal($data)
    {
        $value = $this->form->model()->getMedia($this->column());

        foreach ($value as $key => $media) {
            $this->original[$key] = $media->id;
        }
    }

    // public function prepare($files)
    // {
    //     if (request()->has(static::FILE_DELETE_FLAG)) {
    //         return $this->destroy(request(static::FILE_DELETE_FLAG));
    //     }
    //
    //     $targets = array_map([$this, 'prepareMedia'], $files);
    //
    //     return array_merge($this->original(), $targets);
    // }

    protected function prepareForeach(UploadedFile $file = null)
    {
        $this->name = $this->getStoreName($file);

        $media = $this->form
            ->model()
            ->addMedia($file)
            ->preservingOriginal()
            ->withResponsiveImages()
            ->toMediaCollection($this->column())
            ->toArray();

        $media[NestedForm::REMOVE_FLAG_NAME] = 0;

        return tap($media, function () {
            $this->name = null;
        });
    }

    protected function initialPreviewConfig()
    {
        $files = $this->value ?: [];

        $config = [];

        $medias = Media::whereIn('id', $files)->get();

        foreach ($medias as $media) {
            $type = $this->getMimeType($media->mime_type);

            $entry = [
                'caption' => $media->file_name,
                'key' => $media->id,
                'size' => $media->size,
            ];

            if (!empty($type)) {
                $entry['type'] = $type;
            }

            $config[] = $entry;
        }

        return $config;
    }

    public function destroy($key)
    {
        $files = $this->original ?: [];

        foreach ($files as $fileKey => $file) {
            if ($file == $key) {
                $media = Media::whereId($key)->first();
                $media->delete();
            }
        }

        return array_values($files);
    }
}
