@extends('books.public.layouts.default')
@section('title') Welcome @endsection
@section('style')

@endsection
@section('content')


  <div class="row">

      <div class="col s12 m3">
          <form id="filter_form" method="post">
              {{ csrf_field() }}
            <ul class="collapsible expandable white">
                <li class="active">
                    <div class="collapsible-header">
                        <i class="material-icons">star</i>
                        Ratings
                        <span class="arrow_nav_up"><i class="material-icons">keyboard_arrow_up</i></span>
                        <span class="arrow_nav_down"><i class="material-icons">keyboard_arrow_down</i></span>
                    </div>
                    <div class="collapsible-body">
                        <ul class="filter-star">
                            @for($i=5;$i>=1;$i--)
                                <li class="ratings">
                                    <label>
                                        <input type="radio" name="filter_star"  value="{{$i}}" class="filled-in rating-filter-check" />
                                        <span class="star">
                                            @for($j=1;$j<=$i;$j++)
                                                <i class="material-icons">star</i>
                                            @endfor
                                            @for($k=1;$k<=(5 - ($j - 1));$k++)
                                                <i class="material-icons">star_border</i>
                                            @endfor
                                        </span>
                                    </label>
                                        
                                </li>
                            @endfor
                        </ul>   
                    </div>
                </li>
                <li class="active">
                    <div class="collapsible-header"><i class="material-icons">group_work</i>Category
                        <span class="arrow_nav_up"><i class="material-icons">keyboard_arrow_up</i></span>
                        <span class="arrow_nav_down"><i class="material-icons">keyboard_arrow_down</i></span>
                    </div>
                    <div class="collapsible-body">
                        <ul>
                            @foreach($categories as $category)
                                <li>
                                    <label>
                                        <input type="checkbox"  name="filter_category[]" value="{{$category->id}}" class="filled-in category-filter-check" />
                                        <span>{{$category->name}}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </li>
            </ul>
          </form>

      </div>

      <div class="col s12 m9">
          <div id="infinite-scroll">

          </div>
          <div class="col s12">
            <div class="center">
                <div id="loading" class="center"><img src="https://loading.io/spinners/microsoft/lg.rotating-balls-spinner.gif" height="30" alt="Loading..." /></div>
                <a  id="loadmore" data-filter="false" class="waves-effect waves-light btn"><i class="material-icons left">cloud</i>Load More  </a>
            </div>
          </div>
    </div>

     
</div>
@endsection

@section('scripts')

<script type="text/javascript">
  $(document).ready(function(){
      var loadmore = {
         page : 1,
         loadgetcontent : function(){
            $("#loading").show();
            $(this).load( "{{route('book.ajax.list')}}?page="+this.page,function(response, status, xhr) {
                if(status == 'success'){
                    $("#loading").hide();
                    if(response !== ''){
                        $("#infinite-scroll").append(response);
                        this.page += 1;
                    }else{
                        $("#loadmore").hide();
                    }
                }
            });
         },
         loadpostcontent : function(){
            $("#loading").show();
            var url = '{{route('book.ajax.list')}}?page='+this.page;
            var posting = $.post( url, $('form#filter_form').serialize());
            posting.done(function( response ) {
                $("#loading").hide();
                if(response !== ''){
                    $("#loadmore").show();
                    $("#infinite-scroll").append(response); 
                    $this.page += 1;                   
                }else{
                    $("#loadmore").hide();
                }
            });
            this.page += 1;
         },
         reset : function(){
             this.page = 1;
         }
      }

      loadmore.loadgetcontent();
      
      $('#loadmore').click(function(){
          if($(this).attr('data-filter') == 'false'){
                loadmore.loadgetcontent();
          }              
         if($(this).attr('data-filter') == 'true'){
            loadmore.loadpostcontent();
         }              
      });

      $('#filter_form input:checkbox,#filter_form input:radio').click(function(){
          $('#loadmore').attr('data-filter','true');
          $("#infinite-scroll").html('');
          loadmore.reset();
          loadmore.loadpostcontent();
      });

      
      

    $('.collapsible').collapsible({
        accordion:false
    });
  });

</script>
@endsection