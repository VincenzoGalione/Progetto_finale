<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

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

        if (count($this->images) >0 ) {
            foreach ($this->images as $image) {
                $this->article->images()->create(['path' => $image->store('images', 'public')]);
            }
        }

        $this->reset();
        session()->flash('success', 'Articolo creato correttamente');
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
