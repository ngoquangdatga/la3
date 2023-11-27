<?php

namespace App\Repositories;

class BannerRepository extends EloquentRepository
{

    public function getModel()
    {
        return \App\Banner::class;
    }

    public function handleUploadedImage($image)
    {
        if($file = $image){
            $image = 'banner-'.time().'.'.$file->getClientOriginalExtension();
            $file->move('../public/images1/banner/', $image);
        }
        return $image;
    }

}
