<!-- @extends('templates.show')

@section('show_content') -->
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                {{ $item->name }}
            </div>
        </div>
    </div>
    <div class="col-md-9">



        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="teeth-tab" data-bs-toggle="tab" data-bs-target="#teeth-tab-pane"
                    type="button" role="tab" aria-controls="teeth-tab-pane" aria-selected="true">Teeth</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="medicalRecord-tab" data-bs-toggle="tab"
                    data-bs-target="#medicalRecord-tab-pane" type="button" role="tab"
                    aria-controls="medicalRecord-tab-pane" aria-selected="false">Medical Records</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="procedure-tab" data-bs-toggle="tab" data-bs-target="#procedure-tab-pane"
                    type="button" role="tab" aria-controls="procedure-tab-pane"
                    aria-selected="false">Procedures</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="appointment-tab" data-bs-toggle="tab"
                    data-bs-target="#appointment-tab-pane" type="button" role="tab" aria-controls="appointment-tab-pane"
                    aria-selected="false">Appointment</button>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="teeth-tab-pane" role="tabpanel" aria-labelledby="teeth-tab"
                tabindex="0">

                <div class="card card-body">
                    @foreach ($item->teeths as $teeth)
                    {{ $teeth->types }}
                    @endforeach

                    {{-- Teeth --}}
                    <div class="tab-pane fade show active" id="teeth-tab" role="tabpanel" aria-labelledby="teeth-tab"
                        tabindex="0">
                        <form action="{{ route($route . 'update', $item->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label> Patient Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $item->name }}">

                            </div>

                            <div class="form-group">
                                <label>Teeth-Types</label>
                                <input type="text" name="types" class="form-control" placeholder="Enter Teeth-Types"
                                    @foreach ($item->teeths as $teeth) value="{{ $teeth->types }}" @endforeach >
                            </div>

                            <div class="form-group">
                                <label>X-ray</label>
                                <input type="text" name="image" class="form-control" placeholder="Enter X-ray">

                            </div>


                            <div class="form-group">
                                <label>Condition</label>

                                <input type="text" name="condition" class="form-control" @foreach ($item->teeths as
                                $teeth) value="{{ $teeth->condition }}" @endforeach>


                            </div>


                        </form>
                    </div>




                        
                       
                    <div class="tab-pane fade" id="appointment-tab" role="tabpanel" aria-labelledby="appointment-tab"
                            tabindex="0">
    
                            <div class="card card-body">
    
    
                                {{-- Appointment --}}
                                <form action="">
                                    @csrf
    
                                    <div class="form-group">
                                        <label> Patient Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                        {{-- value="{{old('name',$item->name)}}" --}}
                                    </div>
    
                                    <div class="form-group">
                                        <label> Dentist Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                        {{-- value="{{old('name',$item->name)}}" --}}
                                    </div>
    
                                    <div class="form-group">
                                        <label> Date/Time Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                        {{-- value="{{old('name',$item->name)}}" --}}
                                    </div>
    
                                    <div class="form-group">
                                        <label> Status</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                        {{-- value="{{old('name',$item->name)}}" --}}
                                    </div>
    
                                    <div class="form-group">
                                        <label> Notes</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name">
                                        {{-- value="{{old('name',$item->name)}}" --}}
                                    </div>
    
                                </form>
    
                            </div>
    
    
                        </div>
                    </div>
    
    
                </div>
            </div> 
    
                </div>
                <div class="tab-pane fade" id="medicalRecord-tab-pane" role="tabpanel" aria-labelledby="medicalRecord-tab"
                    tabindex="0">
                
                    <div class="tab-pane fade" id="medicalRecords-tab" role="tabpanel"
                    aria-labelledby="medicalRecords-tab" tabindex="0">
                    <div class="card card-body">


                        <!-- {{-- Medical Records --}}
                        <form action="">
                            @csrf

                            <div class="form-group">
                                <label> Patient Name</label>
                                <input type="text" name="medical_condition" class="form-control"
                                    placeholder="Enter Name">
                                {{-- value="{{old('name',$item->name)}}" --}}
                            </div>

                            <div class="form-group">
                                <label> Patient Name</label>
                                <input type="text" name="allergies" class="form-control"
                                    placeholder="Enter Name">
                                {{-- value="{{old('name',$item->name)}}" --}}
                            </div>

                        </form> -->


                    </div>

                </div>

                </div>


                <div class="tab-pane fade" id="procedure-tab-pane" role="tabpanel" aria-labelledby="procedure-tab"
                    tabindex="0">

                    <div class="tab-pane fade" id="procedure-tab" role="tabpanel" aria-labelledby="procedure-tab"
                    tabindex="0">

                    <div class="card card-body">


                         {{-- Procedure --}}
                        
                    </div> 

                </div>


                </div>
                <div class="tab-pane fade" id="appointment-tab-pane" role="tabpanel" aria-labelledby="appointment-tab"
                    tabindex="0">...</div>
            </div>
 
 
             <div class="tab-content" id="myTabContent">
                <div class="card card-body">
                    @foreach ($item->teeths as $teeth)
                        {{ $teeth->types }}
                    @endforeach

                  {{--}}  Teeth --}}
                    <div class="tab-pane fade show active" id="teeth-tab" role="tabpanel" aria-labelledby="teeth-tab"
                        tabindex="0">
                        <form action="{{ route($route . 'update', $item->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label> Patient Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $item->name }}">

                            </div>

                            <div class="form-group">
                                <label>Teeth-Types</label>
                                <input type="text" name="types" class="form-control"
                                    placeholder="Enter Teeth-Types"
                                    @foreach ($item->teeths as $teeth) value="{{ $teeth->types }}" @endforeach>
                            </div>

                            <div class="form-group">
                                <label>X-ray</label>
                                <input type="text" name="image" class="form-control" placeholder="Enter X-ray">

                            </div>


                            <div class="form-group">
                                <label>Condition</label>

                                <input type="text" name="condition" class="form-control"
                                    @foreach ($item->teeths as $teeth) value="{{ $teeth->condition }}" @endforeach>


                            </div>


                        </form>
                    </div>




                    <div class="tab-pane fade" id="procedure-tab" role="tabpanel" aria-labelledby="procedure-tab"
                        tabindex="0">

                        <div class="card card-body">


                            {{-- Procedure --}}
                            <form action="">
                                @csrf
                                <div class="form-group">
                                    <label> Patient Name</label>
                                    <input type="text" name="user_id" class="form-control" placeholder="Enter Name">
                                    {{-- value="{{old('name',$item->name)}}" --}}
                                </div>

                                <div class="form-group">
                                    <label> Service Name</label>
                                    <input type="text" name="service_id" class="form-control"
                                        placeholder="Enter Name">
                                    {{-- value="{{old('name',$item->name)}}" --}}
                                </div>

                                <div class="form-group">
                                    <label> Appointment Name</label>
                                    <input type="text" name="appointment_id" class="form-control"
                                        placeholder="Enter Name">
                                    {{-- value="{{old('name',$item->name)}}" --}}
                                </div>

                                <div class="form-group">
                                    <label> Teeth Name</label>
                                    <input type="text" name="teeth_id" class="form-control" placeholder="Enter Name">
                                    {{-- value="{{old('name',$item->name)}}" --}}
                                </div>

                                <div class="form-group">
                                    <label> Description</label>
                                    <input type="text" name="description" class="form-control"
                                        placeholder="Enter Name">
                                    {{-- value="{{old('name',$item->name)}}" --}}
                                </div>

                                <div class="form-group">
                                    <label> Cost</label>
                                    <input type="text" name="cost" class="form-control" placeholder="Enter Name">
                                    {{-- value="{{old('name',$item->name)}}" --}}
                                </div>

                            </form>
                        </div>

                    </div>


                    <div class="tab-pane fade" id="appointment-tab" role="tabpanel" aria-labelledby="appointment-tab"
                        tabindex="0">

                        <div class="card card-body">


                          

                        </div>


                    </div>
                </div>


            </div> 
        </div> 


        {{-- 
            {{-- <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="teeth-tab-pane" role="tabpanel" aria-labelledby="teeth-tab"
                    tabindex="0">
                    
                    <div class="card card-body">
                        @foreach ($item->teeths as $teeth)
                            {{ $teeth->types }}
                        @endforeach
    
                        {{-- Teeth 
                        <div class="tab-pane fade show active" id="teeth-tab" role="tabpanel" aria-labelledby="teeth-tab"
                            tabindex="0">
                            <form action="{{ route($route . 'update', $item->id) }}" method="post">
                                @csrf
                                @method('PUT')
    
                                <div class="form-group">
                                    <label> Patient Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $item->name }}">
    
                                </div>
    
                                <div class="form-group">
                                    <label>Teeth-Types</label>
                                    <input type="text" name="types" class="form-control"
                                        placeholder="Enter Teeth-Types"
                                        @foreach ($item->teeths as $teeth) value="{{ $teeth->types }}" @endforeach>
                                </div>
    
                                <div class="form-group">
                                    <label>X-ray</label>
                                    <input type="text" name="image" class="form-control" placeholder="Enter X-ray">
    
                                </div>
    
    
                                <div class="form-group">
                                    <label>Condition</label>
    
                                    <input type="text" name="condition" class="form-control"
                                        @foreach ($item->teeths as $teeth) value="{{ $teeth->condition }}" @endforeach>
    
    
                                </div>
    
    
                            </form>
                        </div>--}}


                        <div class="tab-content" id="myTabContent">

<div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

    <div class="card card-body">
        @foreach ($item->teeths as $teeth)
            {{ $teeth->types }}
        @endforeach

        {{-- Teeth --}}
        <div class="tab-pane fade show active" id="teeth-tab" role="tabpanel" aria-labelledby="teeth-tab"
            tabindex="0">
            <form action="{{ route($route . 'update', $item->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label> Patient Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $item->name }}">

                </div>

                <div class="form-group">
                    <label>Teeth-Types</label>
                    <input type="text" name="types" class="form-control"
                        placeholder="Enter Teeth-Types"
                        @foreach ($item->teeths as $teeth) value="{{ $teeth->types }}" @endforeach>
                </div>

                <div class="form-group">
                    <label>X-ray</label>
                    <input type="text" name="image" class="form-control" placeholder="Enter X-ray">

                </div>


                <div class="form-group">
                    <label>Condition</label>

                    <input type="text" name="condition" class="form-control"
                        @foreach ($item->teeths as $teeth) value="{{ $teeth->condition }}" @endforeach>


                </div>


            </form>
        </div>

</div>
    
    
                    
