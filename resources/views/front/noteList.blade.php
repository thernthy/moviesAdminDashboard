@extends('front.layout')

@push('styles') 
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
<style>
   #nav {
        background-color: #1D1D1D !important; 
        transition: all .5s;
    }
    .dropdow-wraper.wrap{
        background-color: #1D1D1D !important;
    }
    .row.message-table >ul.messgae-list-wraper {
        margin-top:3rem;    
        display: flex;
        flex-direction:column;
        align-items:center;
        justify-content:space-between;
    }
    .row.message-table >ul.messgae-list-wraper > .message-content-wraper{
        width: 100%;
        border-bottom:1px solid gray;
        transition:all .5s;
    }
    
    .row.message-table ul.messgae-list-wraper li > ul{
        display: flex;
        flex-direction:row;
        gap: 10px;
        padding: 5px 10px;
        width: 100%;
        align-items:center;
        justify-content:space-between;
        transition:all .5s ;
    }
    .row.message-table ul.messgae-list-wraper li > ul.table-header{
        padding:5px 10px;
        background:black;
        border-radius:10px 10px 0px 0px;
    }
    .row.message-table ul.messgae-list-wraper li > ul.content_header {
        padding:20px 10px;
    }
    .row.message-table ul.messgae-list-wraper li > ul.content_header li{
        font-size:1.3rem;
        color:#fff;
    }
    .row.message-table ul.messgae-list-wraper li  ul.content_header li > i{
        font-size:1.5rem;
        color:#fff;
        transition: all .5s ;
        cursor: pointer;
    }
    .row.message-table ul.messgae-list-wraper li  ul.content_header li > i.active{
       transform:rotate(180deg);
    }
    .row.message-table ul.messgae-list-wraper li  ul.content-message{
       padding:10px 10%;
       font-size: 1.2rem;
       color:#fff;
       font-weight: 200;
       line-height:1.2;
    }
    .row.message-table ul.messgae-list-wraper li  ul.content-message > li{
       line-height:1.5;
    }
    ul.content_header li > i:hover{
        opacity: .8;
    }

    
</style>
@endpush
@section('content')
<div class="container-fuild" id="relative_page">
    <div class="row message-table">
        <ul class="messgae-list-wraper">
            <li class="message-content-wraper">
                <ul class="table-header">
                    <li class="title">
                        <h3>Number</h3>
                    </li>
                    <li class="title">
                        <h3>Nickname</h3>
                    </li>
                    <li class="title">
                        <h3>Title</h3>
                    </li>
                    <li class="title">
                        <h3>Situation</h3>
                    </li>
                    <li class="title">
                        <h3>Date Created</h3>
                    </li>
                </ul>
            </li>
            <li class="message-content-wraper">
                <ul class="content_header">
                    <li>20</li>
                    <li>ku</li>
                    <li>Strongest baseball Up</li>
                    <li>Replaying</li>
                    <li>2024-01-23 12:49:29  <i class="fa-solid fa-circle-chevron-down" onclick="toggleDropdown(this)"></i></li>
                </ul>
                <ul class="content-message dropdown-content" style="display:none;">
                    <li>
                    Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph.
                    </li>
                </ul>
            </li>
            <li class="message-content-wraper">
                <ul class="content_header">
                    <li>20</li>
                    <li>ku</li>
                    <li>Strongest baseball Up</li>
                    <li>Replaying</li>
                    <li>2024-01-23 12:49:29  <i class="fa-solid fa-circle-chevron-down" onclick="toggleDropdown(this)"></i></li>
                </ul>
                <ul class="content-message dropdown-content" style="display:none;">
                    <li>
                    Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph.
                    </li>
                </ul>
            </li>
            <li class="message-content-wraper">
                <ul class="content_header">
                    <li>20</li>
                    <li>ku</li>
                    <li>Strongest baseball Up</li>
                    <li>Replaying</li>
                    <li>2024-01-23 12:49:29  <i class="fa-solid fa-circle-chevron-down" onclick="toggleDropdown(this)"></i></li>
                </ul>
                <ul class="content-message dropdown-content" style="display:none;">
                    <li>
                    Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph.
                    </li>
                </ul>
            </li>
            <li class="message-content-wraper">
                <ul class="content_header">
                    <li>20</li>
                    <li>ku</li>
                    <li>Strongest baseball Up</li>
                    <li>Replaying</li>
                    <li>2024-01-23 12:49:29  <i class="fa-solid fa-circle-chevron-down" onclick="toggleDropdown(this)"></i></li>
                </ul>
                <ul class="content-message dropdown-content" style="display:none;">
                    <li>
                    Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas among sentences is what constitutes a paragraph.
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
@endsection

@push('scripts')
   <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

   <script>
        function toggleDropdown(chevron) {
            var contentWrapper = chevron.closest('.message-content-wraper');
            var dropdownContent = contentWrapper.querySelector('.content-message');
            var DropdownButton = contentWrapper.querySelector('.fa-circle-chevron-down');
            var isDisplayed = dropdownContent.style.display === 'block';
            var allDropdowns = document.querySelectorAll('.content-message');
            var DropdownButtons = document.querySelectorAll('.fa-circle-chevron-down');
            allDropdowns.forEach(function(dropdown) {
                dropdown.style.display = 'none';
            });
            DropdownButtons.forEach(function(button){
                button.classList.remove('active')
            })
            dropdownContent.style.display = isDisplayed ? 'none' : 'block';
            DropdownButton.classList.toggle('active', !isDisplayed);
        }
    </script>
@endpush
