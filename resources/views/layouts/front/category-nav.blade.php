<ul class="list-unstyled list-inline nav navbar-nav">

    <!-- Fará um for para cada categoria -->
    @foreach($categories as $category)
    <!-- Para cada uma ira estar dentro de um li.-->
        <li>
            <!-- Se a categoria, tiver a cotagem de filhos = 0, iremos incluir 
            um layout de categoria, que vem do layouts.front.category-sub. Precisamos passar
            um objeto sub, que ira ser os filhos da categoris. as sub categorias-->
            @if($category->children()->count() > 0)
                @include('layouts.front.category-sub', ['subs' -> $category->children])
            <!-- Se não, ele faz um if dentro de um link
            Se o segmento 2, do request, for igual a slug, do category, ele irá ativar a classe
            -->
            <!-- No link também ele passa um link que é um redirecionamento para rota front.categroy.slug, e passa nossa category->slug para ela, e dentro 
            do link realmente ele usa o category name.-->
            @else 
                <a @if(requset()->segment(2) == $category->slug) class="active" @endif href="{{route('front.category.slug', $category->slug)}}">{{$category->name}} </a>



        </li>



</ul>