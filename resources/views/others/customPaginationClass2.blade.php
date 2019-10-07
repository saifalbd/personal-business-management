




<p style="text-align: center;">{{$info->topText}}</p>
<ul class="pagination alert" style="display: flex; justify-content: center;">


    <li class="page-item service flex-align-self-center"><a class="page-link" href="{{$info->firstPage->url}}">FIRST</a></li>

    <li class="page-item  {{isVal($info->isPreviousPage,false,'disabled','service')}}">
        <a class="page-link"
           href="{{isVal($info->isPreviousPage,true,$info->previousPage->url,'#')}}"
        >< Previus</a></li>


    @foreach($info->urlRange::obj() as $list)


        <li class="page-item {{isVal($list->active,true,'active')}}"><a class="page-link" href="{{$list->url}}">{{$list->page}}</a></li>


    @endforeach


    <li class="page-item {{isVal($info->isNextPage,false,'disabled','service')}}">
        <a class="page-link" href="{{isVal($info->isNextPage,true,$info->nextPage->url,'#')}}">Next ></a></li>

    <li class="page-item service"><a class="page-link" href="{{$info->lastPage->url}}">LAST</a></li>

</ul>

