<?php

namespace App\Admin\Services\MediaLibrary;

use Encore\Admin\Form\Field\File;
use Encore\Admin\Form\NestedForm;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaLibraryFile extends File
{
    use MediaLibrary;

    protected $view = 'admin::form.file';

    public function fill($data)
    {
        parent::fill($data);

        $this->value = $this->form->model()->getMedia($this->column());
        if ($this->value->count()) {
            $this->value = $this->value[0]->id;
        } else {
            $this->value = [];
        }
    }

    public function prepare($file)
    {
        if (request()->has(static::FILE_DELETE_FLAG)) {
            return $this->destroy();
        }

        $this->prepareMedia($file);
    }

    protected function prepareMedia(UploadedFile $file = null)
    {
        $this->name = $this->getStoreName($file);

        $this->form->model()->clearMediaCollection($this->column());

        $media = $this->form
            ->model()
            ->addMedia($file)
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
        $file = $this->value;

        $config = [];

        $media = Media::where('id', '=', $file)->first();

        $type = $this->getMimeType($media->mime_type);

        $entry = [
            'caption' => $media->file_name,
            'key'     => $media->id,
            'size'    => $media->size
        ];

        if (!empty($type)) {
            $entry['type'] = $type;
        }

        $config[] = $entry;

        return $config;
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
        $value = $this->form->model()->getMedia($this->column);
        if ($value->count()) {
            $this->original = $value[0]->id;
        }
    }

    public function destroy()
    {
        $id = $this->original;

        if ($id) {
            $media = Media::whereId($id)->first();
            $media->delete();
        }
    }
}
