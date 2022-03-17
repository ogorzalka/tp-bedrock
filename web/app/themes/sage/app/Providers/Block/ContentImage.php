<?php

namespace App\Providers\Block;

use AmphiBee\AcfBlocks\Block;
use Illuminate\Support\ServiceProvider;
use WordPlate\Acf\Fields\Image;
use WordPlate\Acf\Fields\Text;
use WordPlate\Acf\Fields\WysiwygEditor;

class ContentImage extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Block::make('Contenu + Image')
            ->setView('blocks.content-image')
            ->enableJsx()
            ->setFields([
                Text::make('Titre', 'block_title'),
                WysiwygEditor::make('Contenu', 'block_content'),
                Image::make('Image', 'block_image')->returnFormat('id'),
            ]);
    }

}
