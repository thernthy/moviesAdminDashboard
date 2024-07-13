@extends('crudbooster::admin_template')
@section('content')

<style>
.form-control{
    background: transparent;
}
#app{
    overflow-y: hidden;
}
.select2-container--default .select2-selection--single {
    border-radius: 0px !important;
    height: 35px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3c8dbc !important;
    border-color: #367fa    9 !important;
    color: #fff !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff !important;
}

.spin {
    display: none;
}

.image_wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.image_wrapper>.fa-pen-to-square {
    padding: 10px;
    border-radius: 50%;
    margin-top: 5px;
    background: grey;
    cursor: pointer;
}

.epesode_wrapper {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 10px;
}

.epesode_wrapper .ep_number input {
    width: 50px;
    text-align: center;
}

.epesode_container_wrapper {
    position: relative;
}

.add_button_wrapper {
    position: absolute;
    right: -5px;
    bottom: 50%;
    transform: translateY(10px);
    padding: 5px;
    color: white;
    border-radius: 50%;
    background: #256797;
    cursor: pointer;
}

.center {
    position: absolute;
    display: inline-block;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

/** Custom Select **/
.custom-select-wrapper {
    position: relative;
    display: inline-block;
    user-select: none;
    width: 100%;
}

.custom-select-wrapper select {
    display: none;
}

.custom-select {
    position: relative;
    display: inline-block;
    width: 100%;
}

.custom-select-trigger {
    position: relative;
    display: block;
    padding: 0 84px 0 22px;
    font-weight: 300;
    text-wrap: nowrap;
    line-height: 35px;
    border-radius: 4px;
    cursor: pointer;
}

.custom-select-trigger:after {
    position: absolute;
    display: block;
    content: '';
    width: 10px;
    height: 10px;
    top: 50%;
    right: 25px;
    margin-top: -3px;
    border-bottom: 1px solid #000;
    border-right: 1px solid #000;
    transform: rotate(45deg) translateY(-50%);
    transition: all .4s ease-in-out;
    transform-origin: 50% 0;
}

.custom-select.opened .custom-select-trigger:after {
    margin-top: 3px;
    transform: rotate(-135deg) translateY(-50%);
}

.custom-options {
    position: absolute;
    display: block;
    top: 100%;
    left: 0;
    right: 0;
    min-width: 100%;
    margin: 15px 0;
    border: 1px solid #b5b5b5;
    border-radius: 4px;
    box-sizing: border-box;
    box-shadow: 0 2px 1px rgba(0, 0, 0, .07);
    background: #fff;
    transition: all .4s ease-in-out;
    z-index: 100;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transform: translateY(-15px);
}

.custom-select.opened .custom-options {
    opacity: 1;
    visibility: visible;
    pointer-events: all;
    transform: translateY(0);
}

.custom-options:before {
    position: absolute;
    display: block;
    content: '';
    bottom: 100%;
    right: 25px;
    width: 7px;
    height: 7px;
    margin-bottom: -4px;
    border-top: 1px solid #b5b5b5;
    border-left: 1px solid #b5b5b5;
    background: #fff;
    transform: rotate(45deg);
    transition: all .4s ease-in-out;
}

.option-hover:before {
    background: #f9f9f9;
}

.custom-option {
    position: relative;
    display: block;
    padding: 0 22px;
    border-bottom: 1px solid #b5b5b5;
    color: #b5b5b5;
    line-height: 47px;
    cursor: pointer;
    transition: all .4s ease-in-out;
    z-index: 100;
}

.custom-option:first-of-type {
    border-radius: 4px 4px 0 0;
}

.custom-option:last-of-type {
    border-bottom: 0;
    border-radius: 0 0 4px 4px;
}

.custom-option:hover,
.custom-option.selection {
    background: #f9f9f9;
}


    .multi-select-container {
            position: relative;
            border-radius: 4px;
            padding: 5px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            border: 1px solid rgb(168, 165, 165);
        }

        .multi-select-container input {
            border: none;
            outline: none;
            flex-grow: 1;
            padding: 5px;
            background: transparent;
        }

        .multi-select-container .tag {
            background-color: #f5a866;
            color: white;
            border-radius: 3px;
            padding: 5px;
            margin: 2px;
            display: flex;
            align-items: center;
        }

        .tag .remove-tag {
            margin-left: 5px;
            cursor: pointer;
            width: 20px;
            height: 20px;
            background: #ed9a53;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .multi-select-container > div.dropdown_artors {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
            max-height: 150px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
        }

        .multi-select-container .dropdown_artors.open {
            display: block;
        }

        .multi-select-container .dropdown_artors div {
            padding: 10px;
            cursor: pointer;
        }

        .multi-select-container .dropdown_artors div.selected {
            background-color: #fdca8a;
            margin-top: 2px;
            color: white;
            padding-left: 20px;
        }


        .multi-select-container .dropdown_artors div:hover {
            background-color: #fdca8a;
        }

        .multi-select-container .dropdown_artors div.selected::after {
            content: '✓';
            position: absolute;
            left: 5px;
            color: #68b068;
            font-weight: 800;
        }

</style>

<p>
    <a title='Return' href="{{ crudbooster::adminPath('korean_movies') }}"><i class='fa fa-chevron-circle-left '></i>
        &nbsp; {{cbLang('btn_back')}}</a>
</p>
<div class="panel panel-default" style="background:transparent;">
    <div class="panel-heading">
        <strong><i class="fa fa-tasks"></i>{{cbLang('movie.movies')}}</strong>
    </div>

    <form class="form-horizontal" method="post" id="form" enctype="multipart/form-data"
        action="{{ crudbooster::mainpath('edit-save/'.$editData->id) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="panel-body">
            <div class="form-group row">
                <div class="col-md-offset-2 col-md-6">
                    {{ form_input(cbLang('title'), "title", "text", 10,  "","required value='$editData->title'") }}
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">
                            {{cbLang('select_cateogry')}}<span class="text-danger"
                                title="This field is required">*</span></label>
                        <div class="col-sm-10">
                            <select name="cate_id" id="sources" class="custom-select sources" >
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $editData->cate_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <script>
                                $(".custom-select").each(function() {
                                    var classes = $(this).attr("class"),
                                        placeholder = $(this).attr("placeholder");
                                    
                                    var template = '<div class="' + classes + '">';
                                    template += '<span class="custom-select-trigger form-control">' + (placeholder || $(this).find("option:selected").text()) + '</span>';
                                    template += '<div class="custom-options">';
                                    
                                    $(this).find("option").each(function() {
                                        var selectedClass = $(this).is(":selected") ? "selection" : "";
                                        template += '<span class="custom-option ' + selectedClass + '" data-value="' + $(this).val() + '">' + $(this).text() + '</span>';
                                    });
                                    
                                    template += '</div></div>';
                                    
                                    $(this).wrap('<div class="custom-select-wrapper"></div>');
                                    $(this).hide();
                                    $(this).after(template);
                                });
                                
                                $(".custom-select-trigger").on("click", function(event) {
                                    $('html').one('click', function() {
                                        $(".custom-select").removeClass("opened");
                                    });
                                    $(this).parents(".custom-select").toggleClass("opened");
                                    event.stopPropagation();
                                });
                                
                                $(".custom-option").on("click", function() {
                                    var value = $(this).data("value");
                                    var text = $(this).text();
                                    
                                    $(this).parents(".custom-select-wrapper").find("select").val(value);
                                    $(this).siblings().removeClass("selection");
                                    $(this).addClass("selection");
                                    $(this).parents(".custom-select").removeClass("opened");
                                    $(this).parents(".custom-select").find(".custom-select-trigger").text(text);
                                });
                        </script>
                    </div>
                </div>
            </div>
            @if($editData->actor !== null && $editData->actor !== 'null')
                @php
                    // Initialize $actors as an empty array
                    $actors = [];
                    // Check if $editData->actor is a string and not an array
                    if (is_string($editData->actor)) {
                        // Assuming $editData->actor is a JSON string, decode it to an array
                        $decodedActors = json_decode($editData->actor, true);
                        
                        // Check if json_decode was successful, otherwise use explode for comma-separated values
                        if (json_last_error() == JSON_ERROR_NONE) {
                            $actors = $decodedActors;
                        } else {
                            $actors = explode(',', $editData->actor);
                        }
                    } elseif (is_array($editData->actor)) {
                        // If it's already an array, just assign it to $actors
                        $actors = $editData->actor;
                    }
                
                    // Iterate through the array and echo each actor's name
                    if (empty($actors)) {
                        echo '<div class="form-group">
                                <div class="col-md-offset-2 col-md-6">
                                    <div class="callout callout-info">
                                        <h4><i class="fa fa-exclamation-circle" style="color: red;"></i> No actors found</h4>
                                    </div>
                                </div>
                            </div>';
                    } 
                @endphp
                <div class="form-group">
                    <label for="multiSelectInput" class="col-sm-2 control-label">
                        {{cbLang('select_actors')}}<span class="text-danger" title="This field is required">*</span>
                    </label>
                    <div class="multi-select-container col-md-6" id="multiSelectContainer">
                        @foreach($tbl_actors as $selected_actor)
                            @if(in_array($selected_actor->name, $actors))
                                <div class="tag">{{ $selected_actor->name }}<span class="remove-tag" onclick="removeTag(this)"> x</span></div>
                            @endif
                        @endforeach
                        <input type="text" id="multiSelectInput" placeholder="{{cbLang('select_actors')}}..." onfocus="toggleDropdown(true)" oninput="filterOptions()">
                        <div class="dropdown_artors" id="dropdown">
                            @foreach($tbl_actors as $list_actor)
                            <div onclick="toggleTag('{{ $list_actor->name }}')" class="{{ in_array($list_actor->name, $actors) ? 'selected' : '' }}">
                                {{ $list_actor->name }}
                            </div>
                            @endforeach
                        </div>
                        <div id="hiddenInputsContainer">
                            @foreach($actors as $actor)
                                <input type="hidden" name="selected_actors[]" value="{{ $actor }}">
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="form-group">
                    <label for="multiSelectInput" class="col-sm-2 control-label">
                        {{cbLang('select_actors')}}<span class="text-danger" title="This field is required">*</span>
                    </label>
                    <div class="multi-select-container col-md-6" id="multiSelectContainer">
                        <input type="text" id="multiSelectInput" placeholder="{{cbLang('select_actors')}}..." onfocus="toggleDropdown(true)" oninput="filterOptions()">
                        <div class="dropdown_artors" id="dropdown">
                            @foreach($tbl_actors as $list_actor)
                            <div onclick="toggleTag('{{ $list_actor->name }}')">
                                {{ $list_actor->name }}
                            </div>
                            @endforeach
                        </div>
                        <div id="hiddenInputsContainer">
                            <input type="hidden" name="selected_actors[]" value="">
                        </div>
                    </div>
                </div>
            @endif
            <script>
                            function toggleDropdown(show) {
                                document.getElementById('dropdown').classList.toggle('open', show);
                            }

                            function toggleTag(tag) {
                                const container = document.getElementById('multiSelectContainer');
                                const input = document.getElementById('multiSelectInput');
                                const existingTags = Array.from(container.querySelectorAll('.tag')).map(tagEl => tagEl.textContent.trim().slice(0, -1).trim());
                                const tagIndex = existingTags.indexOf(tag.trim());

                                if (tagIndex !== -1) {
                                    // Remove the tag if it exists
                                    const tagToRemove = Array.from(container.querySelectorAll('.tag')).find(tagEl => tagEl.textContent.trim().slice(0, -1).trim() === tag.trim());
                                    if (tagToRemove) tagToRemove.remove();
                                } else {
                                    // Add the tag if it doesn't exist
                                    const tagEl = document.createElement('div');
                                    tagEl.className = 'tag';
                                    tagEl.innerHTML = `${tag}<span class="remove-tag" onclick="removeTag(this)"> x</span>`;
                                    container.insertBefore(tagEl, input);
                                }

                                // Update the dropdown options to reflect selection
                                const dropdownOptions = document.getElementById('dropdown').children;
                                for (let option of dropdownOptions) {
                                    if (option.textContent.trim() === tag.trim()) {
                                        option.classList.toggle('selected');
                                    }
                                }

                                input.value = '';
                                updateHiddenInputs();
                                filterOptions();
                            }

                            function removeTag(element) {
                                const tag = element.parentElement.textContent.trim().slice(0, -1).trim();
                                element.parentElement.remove();
                                updateDropdownSelection(tag);
                                updateHiddenInputs();
                                filterOptions();
                            }

                            function filterOptions() {
                                const input = document.getElementById('multiSelectInput').value.toLowerCase().trim();
                                const dropdown = document.getElementById('dropdown');
                                const options = dropdown.getElementsByTagName('div');
                                const existingTags = Array.from(document.getElementById('multiSelectContainer').querySelectorAll('.tag')).map(tagEl => tagEl.textContent.trim().slice(0, -1).trim());

                                for (let option of options) {
                                    option.style.display = option.textContent.toLowerCase().includes(input) ? '' : 'none';
                                    option.classList.toggle('selected', existingTags.includes(option.textContent.trim()));
                                }

                                toggleDropdown(true);
                            }

                            function updateDropdownSelection(tag) {
                                const dropdownOptions = document.getElementById('dropdown').children;
                                for (let option of dropdownOptions) {
                                    if (option.textContent.trim() === tag.trim()) {
                                        option.classList.remove('selected');
                                    }
                                }
                            }

                            function updateHiddenInputs() {
                                const container = document.getElementById('multiSelectContainer');
                                const hiddenInputsContainer = document.getElementById('hiddenInputsContainer');
                                const selectedTags = Array.from(container.querySelectorAll('.tag')).map(tagEl => tagEl.textContent.trim().slice(0, -1).trim());

                                // Clear previous hidden inputs
                                hiddenInputsContainer.innerHTML = '';

                                // Add new hidden inputs for each selected tag
                                selectedTags.forEach(tag => {
                                    const hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'selected_actors[]';
                                    hiddenInput.value = tag;
                                    hiddenInputsContainer.appendChild(hiddenInput);
                                });
                            }

                            document.addEventListener('click', function(event) {
                                const container = document.getElementById('multiSelectContainer');
                                if (!container.contains(event.target)) {
                                    toggleDropdown(false);
                                }
                            });
            </script>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <div class="callout callout-info">
                        <h4><i class="fa fa-exclamation-circle"></i> Note:</h4>
                        <p>{{cbLang('You_can_add_new_artore_by_flowing_this_link')}} <a href="#" style="color: blue;">{{cbLang('add_actor')}}</a></p>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-offset-2 col-md-6">
                    {{ form_textarea(cbLang('dcr'), "des", "textarea", "", "$editData->des") }}
                </div>
            </div>
            @if($editData->image != null)
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <div class="image_wrapper col-md-offset-2 col-md-6">
                        <img style="max-width:160px" title="image" src="{{ $editData->image }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6" id="image_url_input" style="display:none;">
                    {{ form_input(cbLang('image_url'), "image", "text", 10,  "","value='$editData->image'") }}
                </div>
            </div>
            <script>
                document.querySelector('.fa-pen-to-square').addEventListener('click', function() {
                    document.getElementById('image_url_input').style.display = 'block';
                });
                </script>
            @else
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    {{ form_input(cbLang('image_url'), "image", "text", 10,  "","value='$editData->image'") }}
                </div>
            </div>
            @endif
            
            <div class="form-group">
                <div class="col-md-offset-2 col-md-6">
                    <h3>Video url</h3>
                    <div class="callout callout-info epesode_container_wrapper">
                        @if($video_url->count() != 0)
                        @foreach($video_url as $episode)
                        <div class="epesode_wrapper">
                            <div class="input_url" style="width:100%; position: relative;">
                                <input type="text" class="form-control col-md-6" name="video_url"
                                    value="{{ $episode->bunny_url }}" placeholder="{{ cbLang('url') }}">
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="epesode_wrapper">
                            <div class="input_url" style="width:100%; position: relative;">
                                <input type="text" class="form-control col-md-6" name="video_url" value=""
                                    placeholder="{{ cbLang('url') }}">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <div class="panel-footer">
            <input type="submit" name="submit" value="{{ cbLang('button_save_more') }}" class='btn btn-success'>
            <input type="submit" name="submit" class="btn btn-primary" value="{{ cbLang('button_save') }}">
        </div>
    </form>
</div>



@endsection