  <ul class="app-bar-menu ml-auto">
        
        @if($topMenu)



      <li 

v-for="(list ,index) in {{$topMenu}}" :key="index"
      ><a :href="list.link">@{{list['txt']}}</a>
  </li>
	 {{--
   @foreach($topMenu as $list)
       <li><a href="{{$list['link']}}">{{$list['txt']}}</a></li>
    
            
@endforeach

 --}}

      
  @endif
    </ul>