<?php

namespace App\Livewire;

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use App\Models\Article;
use Livewire\Component;
use App\Jobs\ResizeImage;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CreateArticleForm extends Component
{

    use WithFileUploads;

    #[Validate('required|min:5')]
    public $title;

    #[Validate('required|min:10')]
    public $description;

    #[Validate('required|numeric')]
    public $price;

    #[Validate('required')]
    public $category;
    
    public $article;

    public $images = [];

    public $temporary_images;


    public function store(){
        $this->validate();
        $this->article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'category' => $this->category,
            'user_id' => Auth::id()
        ]);

        if (count($this->images) > 0 ) {
            foreach ($this->images as $image) {
                $newFileName =  "articles/{$this->article->id}";
                $newImage = $this->article->images()->create(['path' => $image->store($newFileName, 'public')]);
                dispatch(new ResizeImage($newImage->path, 300, 300));  
                dispatch(new GoogleVisionSafeSearch($newImage->id));
                dispatch(new GoogleVisionLabelImage($newImage->id));
                // RemoveFaces::withChain([
                //     new ResizeImage($newImage->path, 300, 300),
                //     new GoogleVisionSafeSearch($newImage->id),
                //     new GoogleVisionLabelImage($newImage->id)
                // ])->dispatch($newImage->id);

            }

            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }

        session()->flash('success', 'Articolo creato correttamente');
        $this->reset();
    }



    public function messages() 
    {
        return [
            'title.required' => 'Il titolo non è stato inserito',
            'title.min' => 'Il titolo deve contenere almeno 5 caratteri',

            'description.required' => 'La descrizione non è stata inserita',
            'description.min' => 'La descrizione deve contenere almeno 10 caratteri',

            'price.required' => 'Il prezzo non è stato inserito',
            'price.numeric' => 'Il prezzo deve essere un valore numerico',

            'category.required' => 'La categoria non è stata inserita',
  
        ];
    }


    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images.*' =>'image|max:1024',
            'temporary_images' =>'max:6'

        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] =$image;
            }
        }
    }


    public function removeImage($key)
    {
        if(in_array($key, array_keys($this->images))){
            unset($this->images[$key]);
        }
    }


    public function render()
    {
        return view('livewire.create-article-form');
    }
}
