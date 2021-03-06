@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Plan Diet
                    <span class="pull-right"><a href="/dietPlan/create" class="btn btn-success btn-xs">Add Diet Plan</a></span>
                </div>
                <div class="panel-body">
                    @if(!empty($dietPlan[0]))
                        <h2 class="text-primary">{{$dietPlan[0]->calories_day}}}}</h2>
                    @endif
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Search Foods</div>
                <div class="panel-body">
                    {!!Form::open(['action' => 'QueryController@search','method' => 'GET'])!!}
                    {!! Form::text('search', null, ['required', 'class'=>'form-control', 'placeholder'=>'Search for food...']) !!}
                    {{Form::bsSubmit('Search')}}
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Foods
                    <span class="pull-right"><a href="/foods/create" class="btn btn-success btn-xs">Add Food</a></span>
                </div>
                <div class="panel-body">
                    <h3>Your Foods</h3>
                    @if(!empty($foods))
                        <table class="table table-striped">
                            <tr>
                                <th>Food Name</th>
                                <th>Calorie Count</th>
                                <th>Created On</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($foods as $food)
                                <tr>
                                    <td>{{$food->name}}</td>
                                    <td>{{$food->calorie_count}}</td>
                                    <td>{{ date('F d, Y', strtotime($food->created_at))}}</td>
                                    <td><a class="pull-right btn btn-default" href="/foods/{{$food->id}}/edit">Edit</a>
                                    </td>
                                    <td>
                                        {!!Form::open(['action' => ['FoodListingController@destroy', $food->id],'method' => 'POST', 'class' => 'pull-left', 'onsubmit' => 'return confirm("Are you sure?")'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::bsSubmit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
