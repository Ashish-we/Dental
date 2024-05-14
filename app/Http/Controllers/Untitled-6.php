      {{--
        <button class="btn btn-info text-white"> <a href="{{route('appointments.create')}}" class="text-white" style="text-decoration:none">New Appointment</a></button>


        <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="procedure-tab" data-bs-toggle="tab"
                                        data-bs-target="#procedure-tab-pane" type="button" role="tab"
                                        aria-controls="procedure-tab-pane" aria-selected="false">Procedures</button>
                                </li>
                            <div>
                                <div class="form-group">
                                    <label>Teeth-Types</label>

 
                                    <input type="text" name="types" class="form-control"
                                        placeholder="Enter Teeth-Types"
                                        @foreach ($item->teeths as $teeth)
                                          @foreach ($teeth->types as $type)
                                             value="{{ $type->name }}" @endforeach
                                        @endforeach > 

                                    <select multiple name="type_ids[]" id="" class="form-control">

                                        @foreach ($item->teeths as $teeth)
                                            @foreach ($teeth->types as $type)
                                                <option value="">
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>X-ray</label>
                                    <input type="file" name="image" class="form-control" placeholder="Enter X-ray">

                                </div>


                                <div class="form-group">
                                    <label>Condition</label>

                                    <input type="text" name="condition" class="form-control"
                                        @foreach ($item->teeths as $teeth) value="{{ $teeth->condition }}" @endforeach>


                                </div>
                            </div>     

                        
                        </div>
            --}}



            {{-- <div>
                            <select name="service_id" id="" class="form-control">
                            @foreach ($services as $service)
                               <option>  {{ $service->name }}</option> 
                            @endforeach
                          
                        </select>
                        </div> --}}



                        {{-- <div class="card card-body">

                  @php
                foreach ($item->teeths as $teeth)
              
              
                $value=[];
                foreach($teeth->types as $type)
                array_push($value, $type)
                        
           
                // {{ $teeth }}
            
                @endphp 
            </div>  --}}




Central Incisors:

Maxillary Central Incisors: #8 and #9
Mandibular Central Incisors: #24 and #25
Lateral Incisors:

Maxillary Lateral Incisors: #7 and #10
Mandibular Lateral Incisors: #23 and #26
Canines (Cuspids):

Maxillary Canines: #6 and #11
Mandibular Canines: #22 and #27
Premolars (Bicuspids):

Maxillary First Premolars: #5 and #12
Maxillary Second Premolars: #4 and #13
Mandibular First Premolars: #21 and #28
Mandibular Second Premolars: #20 and #29
Molars:

Maxillary First Molars: #3 and #14
Maxillary Second Molars: #2 and #15
Mandibular First Molars: #19 and #30
Mandibular Second Molars: #18 and #31
Third Molars (Wisdom Teeth): If present, they are #1, #16, #17, and #32 (numbered sequentially from the last molars towards the front)