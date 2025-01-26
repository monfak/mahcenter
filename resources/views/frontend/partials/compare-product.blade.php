@forelse($products as $product)
<form class="addToCompare1" id="formCompare" method="post">
    @csrf
    <input type="hidden" class="productId" value="{{ $product->id }}">
     <a >
       <button type="submit" style="background:none;
            border:none;" data-toggle="tooltip" data-original-title="مقایسه این کالا">
           <img src="{{ asset(image_resize($product->image, ['width' => 600, 'height' => 551])) }}" alt="{{$product->alt}}" 
        class="attachment-thumbnail size-thumbnail wp-post-image" alt="{{$product->name}}"
        srcset=""
        sizes="(max-width: 150px) 100vw, 150px" width="150" height="150">
         <span>  
          {{$product->name}}
          </span>
        
        </button>
    </a>
</form>
@empty
    <div class="row">
        <div id="content" class="col-12">
            <p class="title-section">مقایسه محصول</p>
            <p>هیچ محصولی برای مقایسه وجود ندارد.</p>
        </div>
    </div>
@endforelse