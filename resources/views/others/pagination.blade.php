  @if(isset($info) && $info->hasPages())
  <div class="container pagination-box">
  <div class="grid">
  <div class="row">
  <div class="cell-md-12 d-flex flex-justify-center">
    <p>
      Total Record is {{$info->total()}} show in {{$info->lastItem()-$info->count()+1}} to {{$info->lastItem()}}
    </p>
    
  </div>
  <div class="cell-md-12 d-flex flex-justify-center">
     
    <ul class="pagination no-gap">
        <li class="page-item  @if(!$info->previousPageUrl()) disabled @endif">
            <a class="page-link" href="{{$info->previousPageUrl()}}" tabindex="-1">Previous</a>
        </li>
        @for ($i = 0; $i < ($info->total()/$info->perPage()); $i++)
        <li class="page-item @if($info->currentPage() ==$i+1) active @endif" 
        
        ><a class="page-link" href="{{$info->url($i+1)}}">{{$i+1}}</a></li>
        @endfor
        @if($info->hasMorePages())
        <li class="page-item service" ><a class="page-link" href="{{$info->nextPageUrl()}}">Next</a></li>
        @else

          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1">Next</a>
        </li>
        @endif
    </ul>
  </div>
</div>
 </div>
  </div>
 @endif