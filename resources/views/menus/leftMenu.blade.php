    

  <ul class="v-menu">
    @if($leftMenu)
  
 
  	
 
    <template v-for="(row,index) in {{$leftMenu}}">
        <li class="menu-title" >@{{row['parent']}}</li>

         
           	
          


 <li v-for="(list,index) in row['child']">
 	<a :href="list['link']">
 		<span :class="list['icon'] +' icon'"></span>@{{list['txt']}}


        <span class="counter" v-if="list.counter" v-text="list.counter"></span>
 	</a>
 </li>

  </template>
            
 {{--


    @foreach($leftMenu as $row)
        <li class="menu-title">{{$row['parent']}}</li>
        @foreach($row['child'] as $list)       


 <li>
 	<a href="{{$list['link']}}"><span class="{{$list['icon']}} icon"></span>{{$list['txt']}}</a>
 </li>

@endforeach
            

@endforeach
      --}}
  @endif
      
   
</ul>
