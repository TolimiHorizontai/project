@extends('layouts.admin')

@section('content')

@if($photos)

        <form action="delete/media" method="post" class="form-inline">
 
        {{csrf_field()}}
        {{method_field('delete')}}                   
                
        <div class="form-inline">
                <select name="checkBoxArray" id="" class="form-control col-sm-4">
                        <option value="">Delete</option>
                </select>
        </div>
                          
        <div class="form-inline">
                <input type="submit" name="delete_all" class="btn btn-warning form control" value="GO">
        </div>     

        <table class="table">
            <thead>
            <tr>
                <th>
                        <input type="checkBox" id="options">
                </th>

                <th>ID</th>         
                <th>Name</th>          
                <th>Created at</th>

                
            </tr>
            </thead>

            <tbody>
             
                    @foreach($photos as $photo)
                    <tr>
                        <td>
                        <input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}">
                        </td>
   
                        <td>{{$photo->id}}</td>
                
                        <td><img height="50" src="{{$photo->file ? asset($photo->file) : 'http://Placehold.it/200x200'}}" alt=""></td>
                    
                        <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : 'no date'}}</td>
                     
                    </tr>

                    @endforeach
            
            </tbody>
    </table>

        </form>
@endif

@stop

@section('scripts')

<script>

                $(document).ready(function(){
                
                        $('#options').click(function(){
                
                                if(this.checked){
                
                                        $('.checkBoxes').each(function(){
                                                this.checked = true;
                                        });
                                } else {
                
                                        $('.checkBoxes').each(function(){
                
                                                this.checked = false;
                                        });
                                }
                        });
                });

</script>
@stop