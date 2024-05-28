@extends('frontend.layout.header')
@section('css')
    <link type="text/css" class="js-stylesheet" href="{{ url('public/plugins/parsley/parsley.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .toast-success {
            background-color: #51A351 !important;
            color: #fff !important;
        }
        .navigation .navbar .dropdown-item::before {position: absolute; content: ''; left: 0px !important;}
        th {background-color:#4D525B; color:#fff !important; border: 0 !important;}
        table{width: 100%;}
        /* .btn-primary {background-color: #ec3237; border-color: #ec3237; color: #fff;} */
    
        .carrer-offer h2{
            color:black;
                text-align: -webkit-center;

        }
        p.qq{
            font-size:15px;
        }
        .card-body.text-center.mt-4{  
            padding-top:0; 
        } 
        .card-wrapper {   
        margin: 2% 0;
        }

        /* You can adjust the image size by increasing/decreasing the width, height */
        .custom-circle-image {
        width: 4rem; /* note i used vw not px for better responsive */
        height: 4rem;
        }
        @media screen and (max-width: 730px){
            .custom-circle-image {
        width: 2.5rem; /* note i used vw not px for better responsive */
        height: 2.5rem;
        }
        }
        .custom-circle-image img {
        object-fit: cover;
        }

        .card-title {
        letter-spacing: 1.1px;
        }

        .card-text {
        font-family: 'Poppins', sans-serif;
        font-size: 22px;
        line-height: initial;
        }
    </style>
    <style>
            :root {
        --body-bg-color: #e5ecef;
        --theme-bg-color: #fafafb;
        --body-font: "Poppins", sans-serif;
        --body-color: #2f2f33;
        --active-color: #0162ff;
        --active-light-color: #e1ebfb;
        --header-bg-color: #fff;
        --search-border-color: #efefef;
        --border-color: #d8d8d8;
        --alert-bg-color: #e8f2ff;
        --subtitle-color: #83838e;
        --inactive-color: #f0f0f0;
        --placeholder-color: #9b9ba5;
        --time-button: #fc5757;
        --level-button: #5052d5;
        --button-color: #fff;
        }

        ::-moz-placeholder {
        color: var(--placeholder-color);
        }

        :-ms-input-placeholder {
        color: var(--placeholder-color);
        }

        ::placeholder {
        color: var(--placeholder-color);
        }

        img {
        max-width: 100%;
        }

        .job {
        display: flex;
        flex-direction: column;
        max-width: 100%;
        padding:20px 0px;
        margin: 0 auto;
        overflow: hidden;
        background-color: var(--theme-bg-color);
        }

        .logo {
        display: flex;
        align-items: center;
        font-weight: 600;
        font-size: 18px;
        cursor: pointer;
        }
        .logo img {
        width: 24px;
        margin-right: 12px;
        }

        .user-settings {
        display: flex;
        align-items: center;
        font-weight: 500;
        }
        .user-settings img {
        width: 20px;
        color: #94949f;
        }

        .user-menu {
        position: relative;
        margin-right: 8px;
        padding-right: 8px;
        border-right: 2px solid #d6d6db;
        }
        .user-menu:before {
        position: absolute;
        content: "";
        width: 7px;
        height: 7px;
        border-radius: 50%;
        border: 2px solid var(--header-bg-color);
        right: 6px;
        top: -1px;
        background-color: var(--active-color);
        }

        .user-profile {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        -o-object-fit: cover;
            object-fit: cover; 
        margin-right: 10px;
        }
        
        .wrapper {
        width: 100%;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        scroll-behavior: smooth;
        padding: 15px 40px;
        overflow: auto;
        }

        .search-menu {
        height: 56px;
        white-space: nowrap;
        display: flex;
        flex-shrink: 0;
        align-items: center;
        background-color: var(--header-bg-color);
        border-radius: 8px;
        width: 100%;
        padding-left: 20px;
        }
        .search-menu div:not(:last-of-type) {
        border-right: 1px solid var(--search-border-color);
        }

        .search-bar {
        height: 55px;
        width: 100%;
        position: relative;
        }
        .search-bar input {
        width: 100%;
        height: 100%;
        display: block;
        background-color: transparent;
        border: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 56.966 56.966' fill='%230162ff'%3e%3cpath d='M55.146 51.887L41.588 37.786A22.926 22.926 0 0046.984 23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92 2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 00.083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-size: 14px;
        background-position: 0 50%;
        padding: 0 25px 0 305px;
        }

        .search-location,
        .search-job,
        .search-salary {
        display: flex;
        align-items: center;
        width: 50%;
        font-size: 14px;
        font-weight: 500;
        padding: 0 25px;
        height: 100%;
        }
        .search-location input,
        .search-job input,
        .search-salary input {
        width: 100%;
        height: 100%;
        display: block;
        background-color: transparent;
        border: none;
        }
        .search-location svg,
        .search-job svg,
        .search-salary svg {
        margin-right: 8px;
        width: 18px;
        color: var(--active-color);
        flex-shrink: 0;
        }

        .search-button {
        background-color: var(--active-color);
        height: 55px;
        border: none;
        font-weight: 600;
        font-size: 14px;
        padding: 0 15px;
        border-radius: 0 8px 8px 0;
        color: var(--button-color);
        cursor: pointer;
        margin-left: auto;
        }

        .search.item {
        position: absolute;
        top: 10px;
        left: 25px;
        font-size: 13px;
        color: var(--active-color);
        border: 1px solid var(--search-border-color);
        padding: 8px 10px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        }
        .search.item svg {
        width: 12px;
        margin-left: 5px;
        }
        .search.item:last-child {
        left: 185px;
        }

        .main-container {
        display: flex;
        flex-grow: 1;
        padding-top: 0px;
        }

        .search-type {
        width: 270px;
        display: flex;
        flex-direction: column;
        height: 100%;
        flex-shrink: 0;
        }

        .alert {
        background-color: var(--alert-bg-color);
        padding: 24px 18px;
        border-radius: 8px;
        }
        .alert-title {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
        }
        .alert-subtitle {
        font-size: 13px;
        color: var(--subtitle-color);
        line-height: 1.6em;
        margin-bottom: 20px;
        }
        .alert input {
        width: 100%;
        padding: 10px;
        display: block;
        border-radius: 6px;
        background-color: var(--header-bg-color);
        border: none;
        font-size: 13px;
        }

        .search-buttons {
        border: none;
        color: var(--button-color);
            background-color: #e52334;
        padding: 8px 10px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 14px;
        }

        .job-wrapper {
        padding-top: 20px;
        }

        .job-time {
        padding-top: 20px;
        }
        .job-time-title {
        font-size: 14px;
        font-weight: 500;
        }

        .type-container {
        display: flex;
        align-items: center;
        color: var(--subtitle-color);
        font-size: 13px;
        }
        .type-container label {
        margin-left: 2px;
        display: flex;
        align-items: center;
        cursor: pointer;
        }
        .type-container + .type-container {
        margin-top: 10px;
        }

        .job-number {
        margin-left: auto;
        background-color: var(--inactive-color);
        color: var(--subtitle-color);
        font-size: 10px;
        font-weight: 500;
        padding: 5px;
        border-radius: 4px;
        }

        .job-style {
        display: none;
        }

        .job-style + label:before {
        content: "";
        margin-right: 10px;
        width: 16px;
        height: 16px;
        border: 1px solid var(--subtitle-color);
        border-radius: 4px;
        cursor: pointer;
        }

        .job-style:checked + label:before {
        background-color: var(--active-color);
        border-color: var(--active-color);
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23fff' stroke-width='3' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'%3e%3cpath d='M20 6L9 17l-5-5'/%3e%3c/svg%3e");
        background-position: 50%;
        background-size: 14px;
        background-repeat: no-repeat;
        }

        .job-style:checked + label + span {
        background-color: var(--active-light-color);
        color: var(--active-color);
        }

        .searched-jobs {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        padding-left: 40px;
        }

        @-webkit-keyframes slideY {
        0% {
            opacity: 0;
            transform: translateY(200px);
        }
        }

        @keyframes slideY {
        0% {
            opacity: 0;
            transform: translateY(200px);
        }
        }
        .searched-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        -webkit-animation: slideY 0.6s both;
                animation: slideY 0.6s both;
        }
        .searched-show {
        font-size: 19px;
        font-weight: 600;
        }
        .searched-sort {
        font-size: 14px;
        color: var(--subtitle-color);
        }
        .searched-sort .post-time {
        font-weight: 600;
        color: var(--subtitle-color);
        }
        .searched-sort .menu-icon {
        font-size: 9px;
        color: var(--placeholder-color);
        margin-left: 6px;
        }

        .job-cards {
        padding-top: 20px;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-column-gap: 25px;
        grid-row-gap: 25px;
        -webkit-animation: slideY 0.6s both;
                animation: slideY 0.6s both;
        }
        @media screen and (max-width: 1212px) {
        .job-cards {
            grid-template-columns: repeat(2, 1fr);
        }
        }
        @media screen and (max-width: 930px) {
        .job-cards {
            grid-template-columns: repeat(1, 1fr);
        }
        }

        .job-card {
        padding: 20px 16px;
        background-color: var(--header-bg-color);
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
        }
        .job-card:hover {
        transform: scale(1.02);
        }
        .job-card img {
        width: 46px;
        padding: 10px;
        border-radius: 8px;
        }

        /* heart */
        .job-card svg {
        width: 46px;
        padding: 10px;
        border-radius: 8px;
        }

        .job-card-title {
        font-weight: 600;
        margin-top: 16px;
        font-size: 14px;
        }
        .job-card-subtitle {
        color: var(--subtitle-color);
        font-size: 13px;
        margin-top: 14px;
        line-height: 1.6em;
        } 
        .job-card-header {
        display: flex;
        align-items: flex-start;
        }

        .overview-card:hover {
        background: #ffffff00;
        transition: none;
        transform: scale(1);    
        }
        .overview-card:hover svg {
        box-shadow: none;
        }
        .overview-card:hover .job-overview-buttons .search-buttons.time-button,
        .overview-card:hover .job-overview-buttons .search-buttons.level-button {
        background-color: #ff0007;
        color: #fff;
        }
        .overview-card:hover .job-card-title,
        .overview-card:hover .job-stat {
        color: #f80000;
        }
        .overview-card:hover .job-card-subtitle,
        .overview-card:hover .job-day {
        color: #ec3237;
        }
        .overview-card:hover .overview-wrapper .heart {
        color: #fff;
        border-color: #fff;
        }
        .overview-card:hover .overview-wrapper .heart:hover {
        fill: red;
        stroke: red;
        transform: scale(1.1);
        }

        .detail-button {
        background-color: #ffedee;
            color: #e52334;
        font-size: 11px;
        font-weight: 500;
        padding: 6px 8px;
        border-radius: 4px;
        }
        .detail-button + .detail-button {
        margin-left: 4px;
        }

        .job-card-buttons {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 100%;
        margin-top: 4px;
        }

        .card-buttons,
        .card-buttons-msg {
        padding: 10px;
        width: 100%;
        font-size: 12px;
        cursor: pointer;
        }

        .card-buttons {
        margin-right: 12px;
        }
        .card-buttons-msg {
        background-color: var(--inactive-color);
        color: var(--subtitle-color);
        }

        .menu-dot {
        background-color: var(--placeholder-color);
        box-shadow: -6px 0 0 0 var(--placeholder-color), 6px 0 0 0 var(--placeholder-color);
        width: 4px;
        height: 4px;
        border: 0;
        padding: 0;
        border-radius: 50%;
        margin-left: auto;
        margin-right: 8px;
        }

        .header-shadow {
        box-shadow: 0 4px 20px rgba(88, 99, 148, 0.17);
        z-index: 1;
        }

        @-webkit-keyframes slide {
        0% {
            opacity: 0;
            transform: translateX(300px);
        }
        }

        @keyframes slide {
        0% {
            opacity: 0;
            transform: translateX(300px);
        }
        }
        .job-overview {
        display: flex;
        flex-grow: 1;
        display: none;
        -webkit-animation: slide 0.6s both;
                animation: slide 0.6s both;
        }
        .job-overview-cards {
        display: flex;
        flex-direction: column;
        width: 330px;
        height: 100%;
        flex-shrink: 0;
        }
        .job-overview-card + .job-overview-card {
        margin-top: 20px;
        }
        .job-overview-buttons {
        display: flex;
        align-items: center;
        margin-top: 12px;
        }
        .job-overview-buttons .search-buttons {
        background-color: var(--inactive-color);
        font-size: 11px;
        padding: 6px 8px;
        margin-top: 0;
        font-weight: 500;
        }
        .job-overview-buttons .search-buttons.time-button {
        color: var(--time-button);
        margin-right: 8px;
        }
        .job-overview-buttons .search-buttons.level-button {
        color: var(--level-button);
        }
        .job-overview-buttons .job-stat {
        color: #e52334;
        font-size: 12px;
        font-weight: 500;
        margin-left: auto;
        }
        .job-overview-buttons .job-day {
        color: var(--subtitle-color);
        font-size: 12px;
        margin-left: 8px;
        font-weight: 500;
        }
        .job-overview .overview-wrapper {
        display: flex;
        align-items: center;
        }
        .job-overview .overview-wrapper img:first-child {
        width: 42px;
        margin-right: 10px;
        }
        .job-overview .overview-wrapper .heart {
        background: none;
        box-shadow: none;
        width: 24px;
        padding: 4px;
        color: var(--subtitle-color);
        border: 1px solid var(--border-color);
        margin-left: auto;
        margin-bottom: auto;
        }

        .overview-detail .job-card-title,
        .overview-detail .job-card-subtitle {
        margin-top: 4px;
        }
        .overview-detail .job-card-subtitle {
        font-size: 12px;
        font-weight: 500;
        }

        .job-explain {
        background-color: var(--header-bg-color);
        margin-left: 40px;
        border-radius: 0 0 8px 8px;
        }

        .job-bg {
        border-radius: 8px 8px 0 0;
        -o-object-fit: cover;
            object-fit: cover;
        width: 100%;
        height: 180px;
        transition: 0.3s;
        position: relative;
        }

        .job-logos {
        margin-top: -30px;
        position: relative;
        margin-bottom: -36px;
        padding: 0 20px;
        }
        .job-logos img {
        width: 66px;
        padding: 12px;
        background-color: #fff;
        border-radius: 10px;
        border: 4px solid var(--header-bg-color);
        }

        .job-title-wrapper {
        display: flex;
        align-items: center;
        }
        .job-title-wrapper .job-card-title {
        font-size: 20px;
        margin-top: 0;
        font-weight: 600;
        }

        .job-action {
        display: flex;
        align-items: center;
        margin-left: auto;
        }
        .job-action svg {
        width: 32px;
        border: 1px solid var(--border-color);
        color: var(--subtitle-color);
        border-radius: 8px;
        padding: 6px;
        }
        .job-action svg + svg {
        margin-left: 12px;
        }

        .job-explain-content {
        padding: 50px 25px 30px;
        }

        .job-subtitle-wrapper {
        display: flex;
        align-items: center;
        margin-top: 20px;
        }
        .job-subtitle-wrapper .posted {
        margin-left: auto;
        }
        .job-subtitle-wrapper .company-name {
        color: #e52334;
        font-weight: 600;
        font-size: 14px;
        }
        .job-subtitle-wrapper .comp-location,
        .job-subtitle-wrapper .posted {
        color: var(--subtitle-color);
        font-size: 12px;
        font-weight: 500;
        }
        .job-subtitle-wrapper .comp-location {
        position: relative;
        margin-left: 10px;
        }
        .job-subtitle-wrapper .comp-location:before {
        content: "";
        width: 3px;
        height: 3px;
        border-radius: 50%;
        background-color: var(--placeholder-color);
        top: 49%;
        left: -8px;
        position: absolute;
        }
        .job-subtitle-wrapper .app-number {
        color: var(--body-color);
        position: relative;
        margin-left: 12px;
        }
        .job-subtitle-wrapper .app-number:before {
        content: "";
        width: 3px;
        height: 3px;
        border-radius: 50%;
        background-color: var(--placeholder-color);
        top: 50%;
        left: -7px;
        position: absolute;
        }

        .explain-bar {
        margin-top: 20px;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        display: flex;
        height: 66px;
        padding: 0 16px;
        align-items: center;
        justify-content: space-between;
        }
        .explain-title {
        color: var(--subtitle-color);
        font-size: 12px;
        line-height: 40px;
        white-space: nowrap;
        }
        .explain-subtitle {
        font-size: 13px;
        font-weight: 500;
        margin-top: -2px;
        white-space: nowrap;
        }
        .explain-contents {
        height: 66px;
        }
        .explain-contents + .explain-contents {
        border-left: 1px solid var(--border-color);
        padding-left: 16px;
        }

        .overview-text {
        margin-top: 30px;
        }
        .overview-text-header {
        font-weight: 600;
        margin-bottom: 25px;
        }
        .overview-text-subheader {
        font-size: 13px;
        line-height: 2em;
        }
        .overview-text-item { 
        font-size: 13px;
        position: relative;
        display: flex;
        }
        .overview-text-item + .overview-text-item {
        margin-top: 20px;
        }
        .overview-text-item:before {
        content: "";
        border: 2px solid #61bcff;
        border-radius: 50%; 
        height: 8px;
        width: 8px;
        margin-right: 8px;
        flex-shrink: 0;
        }  

        .detail-page .job-overview {  
            justify-content: center;

        display: flex;
        }
        .detail-page .job-cards,
        .detail-page .searched-bar {
        display: none;
        }
        @media screen and (max-width: 1300px) {
        .detail-page .search-type {
            display: none;
        }
        .detail-page .searched-jobs {
            padding-left: 0;
        }
        }

        @media screen and (max-width: 990px) {
        .explain-contents, .explain-bar {
            height: auto;
        }

        .explain-bar {
            flex-wrap: wrap;
            padding-bottom: 14px;
        }

        .explain-contents {
            width: 50%;
        }

        .explain-contents + .explain-contents {
            padding: 0;
            border: 0;
        }

        .explain-contents:nth-child(2) ~ .explain-contents {
            margin-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .job-subtitle-wrapper {
            flex-direction: column;
            align-items: flex-start;
        }

        .job-subtitle-wrapper .posted {
            margin-left: 0;
            margin-top: 6px;
        }
        }
        @media screen and (max-width: 930px) {
        .search-job, .search-salary {
            display: none;
        }

        .search-bar {
            width: auto;
        }
        }
        @media screen and (max-width: 760px) {
        .detail-page .job-overview-cards {
            display: none;
        }

        .user-name {
            display: none;
        }

        .user-profile {
            margin-right: 0;
        }

        .job-explain {
            margin-left: 0;
        }
        }
        @media screen and (max-width: 730px) {
        .search-type {
            display: none;
        }

        .searched-jobs {
            padding-left: 0;
        }

        .search-menu div:not(:last-of-type) {
            border: 0;
        }

        .job-cards {
            grid-template-columns: repeat(2, 1fr);
        }

        .search-location {
            display: none;
        }
        }
        @media screen and (max-width: 620px) {
        .job-cards {
            grid-template-columns: repeat(1, 1fr);
        }

        .header-menu a:not(:first-child) {
            margin-left: 10px;
        }
        }
        @media screen and (max-width: 590px) {
        .header-menu {
            display: none;
        }
        }
        @media screen and (max-width: 520px) {
        .search.item {
            display: none;
        }

        .search-bar {
            flex-grow: 1;
        }

        .search-bar input {
            padding: 0 0 0 30px;
        }

        .search-button {
            margin-left: 16px;
        }

        .searched-bar {
            flex-direction: column;
            align-items: flex-start;
        }

        .searched-sort {
            margin-top: 5px;
        }

        .main-container {
            padding-top: 20px;
        }
        }
        @media screen and (max-width: 380px) {
        .explain-contents {
            width: 100%;
            margin: 0;
        }

        .explain-contents:nth-child(2) ~ .explain-contents {
            margin: 0;
            border: 0;
        }

        .wrapper {
            padding: 20px;
        }

        .header {
            padding: 0 20px;
        }
        }
    </style>
@endsection

@section('content')
<section id="contact-us">
    <div class="contact-banner">
        @if(isset($career->banner_image) && $career->banner_image)
            <img src="{{url('public/uploads/career/'.$career->banner_image)}}" alt="">
        @endif
    </div>
</section>

<section class="about-cards-section" style="margin-top:20px;">
    <div class="container">
        <div class="carrer-offer">
            <h2 style="color:{{$career->offer_main_title_color}}; font-size:{{$career->offer_main_title_font_size}}; font-family:{{$career->offer_main_title_font_family}};">{{isset($career->offer_main_title) && $career->offer_main_title ? $career->offer_main_title : ''}}</h2>
        </div>
        <div class="row">
            <div class="col-sm-4 card-wrapper">
                <div class="card border-0">
                    <div class="position-relative rounded-circle overflow-hidden mx-auto custom-circle-image">
                        @if(isset($career->offer_first_icon) && $career->offer_first_icon)
                            <img class="w-100 h-100" src="{{url('public/uploads/career_icon1/'.$career->offer_first_icon)}}" alt="Card image cap">
                        @endif
                    </div>
                    <div class="card-body text-center mt-4">
                        <h3 class="card-title" style="font-size:{{$career->offer_first_title_font_size ? $career->offer_first_title_font_size : '1.4em'}};color: {{$career->offer_first_title_color ? $career->offer_first_title_color : '#e52334'}};">{{isset($career->offer_first_title) && $career->offer_first_title ? $career->offer_first_title : ''}}</h3>
                        <p class="qq" style="color:{{$career->offer_first_description_font_color}}; font-size:{{$career->offer_first_description_font_size}}; font-family:{{$career->offer_first_description_font_family}};">{{isset($career->offer_first_description) && $career->offer_first_description ? $career->offer_first_description : ''}}</p>
                    </div>
                </div>
            </div>
    
            <div class="col-sm-4 card-wrapper">
                <div class="card border-0">
                    <div class="position-relative rounded-circle overflow-hidden mx-auto custom-circle-image">
                        @if(isset($career->offer_second_icon) && $career->offer_second_icon)
                            <img class="w-100 h-100" src="{{url('public/uploads/career_icon2/'.$career->offer_second_icon)}}" alt="Card image cap">
                        @endif
                    </div>
                    <div class="card-body text-center mt-4">
                        <h3 class="card-title" style="font-size:{{$career->offer_second_title_font_size ? $career->offer_second_title_font_size : '1.4em'}};color: {{$career->offer_second_title_color ? $career->offer_second_title_color : '#e52334'}};">{{isset($career->offer_second_title) && $career->offer_second_title ? $career->offer_second_title : ''}}</h3>
                        <p class="qq" style="color:{{$career->offer_second_description_font_color}}; font-size:{{$career->offer_second_description_font_size}}; font-family:{{$career->offer_second_description_font_family}};">{{isset($career->offer_second_description) && $career->offer_second_description ? $career->offer_second_description : ''}}</p>
                    </div>
                </div>
            </div>
    
            <div class="col-sm-4 card-wrapper">
                <div class="card border-0">
                    <div class="position-relative rounded-circle overflow-hidden mx-auto custom-circle-image">
                        @if(isset($career->offer_third_icon) && $career->offer_third_icon)
                            <img class="w-100 h-100" src="{{url('public/uploads/career_icon3/'.$career->offer_third_icon)}}" alt="Card image cap">
                        @endif
                    </div>
                    <div class="card-body text-center mt-4">
                        <h3 class="card-title" style="font-size:{{$career->offer_third_title_font_size ? $career->offer_third_title_font_size : '1.4em'}};color: {{$career->offer_third_title_color ? $career->offer_third_title_color : '#e52334'}};">{{isset($career->offer_third_title) && $career->offer_third_title ? $career->offer_third_title : ''}}</h3>
                        <p class="qq" style="color:{{$career->offer_third_description_font_color}}; font-size:{{$career->offer_third_description_font_size}}; font-family:{{$career->offer_third_description_font_family}};">{{isset($career->offer_third_description) && $career->offer_third_description ? $career->offer_third_description : ''}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>    

<div class="job"> 
    <div class="header">
        <div class="user-settings">
            <div class="dark-light"></div>
            <div class="container" style="text-align: -webkit-center;">
                <div class="job-opning-heading"> 
                    <h3 style="color:{{$career->vacancy_sub_title_color}}; font-size:{{$career->vacancy_sub_title_font_size}}; font-family:{{$career->vacancy_sub_title_font_family}};">{{isset($career->vacancy_sub_title) && $career->vacancy_sub_title ? $career->vacancy_sub_title : ''}}</h3>  
                    <h2 style="color:{{$career->vacancy_title_color}}; font-size:{{$career->vacancy_title_font_size}}; font-family:{{$career->vacancy_title_font_family}};">{{isset($career->vacancy_title) && $career->vacancy_title ? $career->vacancy_title : ''}}</h2> 
                </div>
            </div>
        </div>  
    </div>
    <div class="wrapper">
        <div class="main-container">
            <div class="searched-jobs">
                <div class="job-cards">
                    @if(isset($vacancies) && $vacancies)
                        @foreach($vacancies as $record)
                            <div class="job-card">
                                <div class="job-card-header">
                                    <!-- <svg viewBox="0 -13 512 512" xmlns="http://www.w3.org/2000/svg" style="background-color:#2e2882">
                                        <g fill="#feb0a5">
                                            <path d="M256 92.5l127.7 91.6L512 92 383.7 0 256 91.5 128.3 0 0 92l128.3 92zm0 0M256 275.9l-127.7-91.5L0 276.4l128.3 92L256 277l127.7 91.5 128.3-92-128.3-92zm0 0" />
                                            <path d="M127.7 394.1l128.4 92 128.3-92-128.3-92zm0 0" />
                                        </g>
                                        <path d="M512 92L383.7 0 256 91.5v1l127.7 91.6zm0 0M512 276.4l-128.3-92L256 275.9v1l127.7 91.5zm0 0M256 486.1l128.4-92-128.3-92zm0 0" fill="#feb0a5" />
                                    </svg> -->
                                    <img src="{{url('public/uploads/vacancy_icon/'.$record->icon)}}" width="46px" style="background-color:{{$record->icon_background_color}};">
                                    <div class="menu-dot"></div>
                                </div>
                                <div class="job-card-title">{{$record->name}}</div>
                                <div class="company-name" style="display:none;">{{isset($record->businessDetail->title) && $record->businessDetail->title ? $record->businessDetail->title : ''}}
                                    <span class="comp-location"> 
                                        @if($record->showroom_id)
                                            {{isset($record->showroomDetail->name) && $record->showroomDetail->name ? $record->showroomDetail->name : ''}}
                                        @endif
                                        @if($record->service_center_id)
                                            {{isset($record->serviceCenterDetail->name) && $record->serviceCenterDetail->name ? $record->serviceCenterDetail->name : ''}}
                                        @endif
                                        @if($record->body_shop_id)
                                            {{isset($record->bodyShopDetail->name) && $record->bodyShopDetail->name ? $record->bodyShopDetail->name : ''}}
                                        @endif
                                    </span>
                                </div>
                                <textarea name="business_id" style="display:none;" class="business">{{$record->business_id}}</textarea>
                                <textarea name="showroom_id" style="display:none;" class="showroom">{{$record->showroom_id}}</textarea>
                                <textarea name="service_center_id" style="display:none;" class="service_center">{{$record->service_center_id}}</textarea>
                                <textarea name="body_shop_id" style="display:none;" class="body_shop">{{$record->body_shop_id}}</textarea>

                                <div class="explain-subtitle experience" style="display:none;">{{$record->experience}}</div>
                                <div class="explain-subtitle work-level" style="display:none;">{{$record->work_level}}</div>
                                <div class="explain-subtitle employee-type" style="display:none;">{{$record->employee_type}}</div>
                                <div class="explain-subtitle offer-salary" style="display:none;">{{$record->offer_salary}}</div>

                                <div class="job-card-subtitle">{{$record->description}}</div>
                                <div class="job-detail-buttons">
                                    <button class="search-buttons detail-button">Full Time</button>
                                    <button class="search-buttons detail-button">Min. 1 Year</button>
                                    <button class="search-buttons detail-button">Senior Level</button>
                                </div>
                                <div class="job-card-buttons">
                                    <button class="search-buttons card-buttons">Apply Now</button>
                                    <!--<button class="search-buttons card-buttons-msg">Messages</button>-->
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="job-overview">
                    <div class="job-overview-cards">
                        @foreach($vacancies as $vacancy)
                            <div class="job-overview-card">
                                <div class="job-card overview-card">
                                    <div class="overview-wrapper">
                                        <!-- <svg viewBox="0 -13 512 512" xmlns="http://www.w3.org/2000/svg" style="background-color:#2e2882">
                                            <g fill="#feb0a5" >
                                                <path d="M256 92.5l127.7 91.6L512 92 383.7 0 256 91.5 128.3 0 0 92l128.3 92zm0 0M256 275.9l-127.7-91.5L0 276.4l128.3 92L256 277l127.7 91.5 128.3-92-128.3-92zm0 0" />
                                                <path d="M127.7 394.1l128.4 92 128.3-92-128.3-92zm0 0" />
                                            </g>
                                            <path d="M512 92L383.7 0 256 91.5v1l127.7 91.6zm0 0M512 276.4l-128.3-92L256 275.9v1l127.7 91.5zm0 0M256 486.1l128.4-92-128.3-92zm0 0" fill="#feb0a5" />
                                        </svg> -->
                                        <img src="{{url('public/uploads/vacancy_icon/'.$vacancy->icon)}}" width="46px" style="background-color:{{$vacancy->icon_background_color}};;margin-right:10px;">

                                        <div class="overview-detail">
                                            <div class="job-card-title">{{$vacancy->name}}</div>                                            
                                            <div class="company-name" style="display:none;">{{isset($vacancy->businessDetail->title) && $vacancy->businessDetail->title ? $vacancy->businessDetail->title : ''}}
                                                <span class="comp-location"> 
                                                    @if($vacancy->showroom_id)
                                                        {{isset($vacancy->showroomDetail->name) && $vacancy->showroomDetail->name ? $vacancy->showroomDetail->name : ''}}
                                                    @endif
                                                    @if($vacancy->service_center_id)
                                                        {{isset($vacancy->serviceCenterDetail->name) && $vacancy->serviceCenterDetail->name ? $vacancy->serviceCenterDetail->name : ''}}
                                                    @endif
                                                    @if($vacancy->body_shop_id)
                                                        {{isset($vacancy->bodyShopDetail->name) && $vacancy->bodyShopDetail->name ? $vacancy->bodyShopDetail->name : ''}}
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="explain-subtitle experience" style="display:none;">{{$vacancy->experience}}</div>
                                            <div class="explain-subtitle work-level" style="display:none;">{{$vacancy->work_level}}</div>
                                            <div class="explain-subtitle employee-type" style="display:none;">{{$vacancy->employee_type}}</div>
                                            <div class="explain-subtitle offer-salary" style="display:none;">{{$vacancy->offer_salary}}</div>
                                            <div class="job-card-subtitle">
                                                @if($vacancy->showroom_id)
                                                    {{isset($vacancy->showroomDetail->name) && $vacancy->showroomDetail->name ? $vacancy->showroomDetail->name : ''}}
                                                @endif
                                                @if($vacancy->service_center_id)
                                                    {{isset($vacancy->serviceCenterDetail->name) && $vacancy->serviceCenterDetail->name ? $vacancy->serviceCenterDetail->name : ''}}
                                                @endif
                                                @if($vacancy->body_shop_id)
                                                    {{isset($vacancy->bodyShopDetail->name) && $vacancy->bodyShopDetail->name ? $vacancy->bodyShopDetail->name : ''}}
                                                @endif
                                            </div>
                                        </div>
                                        <textarea name="business_id" style="display:none;" class="business">{{$vacancy->business_id}}</textarea>
                                        <textarea name="showroom_id" style="display:none;" class="showroom">{{$vacancy->showroom_id}}</textarea>
                                        <textarea name="service_center_id" style="display:none;" class="service_center">{{$vacancy->service_center_id}}</textarea>
                                        <textarea name="body_shop_id" style="display:none;" class="body_shop">{{$vacancy->body_shop_id}}</textarea>

                                        <svg class="heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                            <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z" />
                                        </svg>
                                    </div>
                                    <div class="job-overview-buttons">
                                        <div class="search-buttons time-button">Full Time</div>
                                        <div class="search-buttons level-button">Senior Level</div>
                                        <div class="job-stat">New</div>
                                        <div class="job-day">4d</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="job-explain">
                        <img class="job-bg">
                        <div class="job-logos">
                        </div>
                        <div class="job-explain-content">
                            <div class="job-title-wrapper">
                                <div class="job-card-title">UI /UX Designer</div>
                                <div class="job-action">
                                    <svg class="heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                        <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z" />
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4"/></svg>
                                </div>
                            </div>
                            <div class="job-subtitle-wrapper">
                                <div class="company-name">Galaxy Toyota<span class="comp-location">Moti Nagar, ND.</span></div>
                                <div class="posted">Posted 8 days ago<span class="app-number">98 Application</span></div>
                            </div>
                            <div class="explain-bar">
                                <div class="explain-contents">
                                    <div class="explain-title">Experience</div>
                                    <div class="explain-subtitle experience">Minimum 1 Year</div>
                                </div>
                                <div class="explain-contents">
                                    <div class="explain-title">Work Level</div>
                                    <div class="explain-subtitle work-level">Senior level</div>
                                </div>
                                <div class="explain-contents">
                                    <div class="explain-title">Employee Type</div>
                                    <div class="explain-subtitle employee-type">Full Time Jobs</div>
                                </div>
                                <div class="explain-contents">
                                    <div class="explain-title">Offer Salary</div>
                                    <div class="explain-subtitle offer-salary">Will be discussed</div>
                                </div>
                            </div>
                            <section id="carrer-form">
                                @if(session('message'))
                                    <div class="alert alert-dismissible alert-info" role="alert" style="margin-left:60px;margin-top:20px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="top:12px"><span aria-hidden="true">&times;</span></button>
                                        <div class="alert-message">
                                            {{ session('message') }}
                                        </div>
                                    </div>
                                @endif
                                <div class="container">
                                    <div class="form-carrer-page">
                                        <form action="" method="POST" id="career_form" enctype="multipart/form-data" data-parsley-validate="">
                                        @csrf
                                            <textarea name="business_id" style="display:none;" class="business" id="business_id"></textarea>
                                            <textarea name="showroom_id" style="display:none;" class="showroom" id="showroom_id"></textarea>
                                            <textarea name="service_center_id" style="display:none;" class="service_center" id="service_center_id"></textarea>
                                            <textarea name="body_shop_id" style="display:none;" class="body_shop" id="body_shop_id"></textarea>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" class="form-control" name="first_name" id="first_name" required>
                                                    <span class="text-danger" id="first-name-error"></span>
                                                    @if ($errors->has('first_name')) <div class="text-danger">{{ $errors->first('first_name') }}</div>@endif
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" id="last_name">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="email">Email Address</label>
                                                    <input type="email" class="form-control" name="email" id="email" required>
                                                    <span class="text-danger" id="email-error"></span>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="contact_no">Contact No.</label>
                                                    <input type="text" class="form-control num_only" name="contact_no" id="contact_no" maxlength="10" required>
                                                    <span class="text-danger" id="contact-error"></span>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="post_apply_for">Post Applying For</label>
                                                    <input type="text" class="form-control" name="post_apply_for" id="post_apply_for">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="resume">Upload your Resume</label>
                                                    <input type="file" class="form-control" name="resume" id="resume">
                                                </div>
                                            </div>
                                            <button type="submit" id="submit" class="btn btn-primary">Sign in</button>
                                        </form>  
                                    </div>
                                </div>  
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('javascript')
<script src="{{ url('public/plugins/parsley/parsley.js') }}"></script>
<script>
    $(document).ready(function(){
        $(document).on('click','#submit',function(e) //id(button)
        {
            e.preventDefault();
            var formData = new FormData();
            var isValid = true;
            first_name = $("#first_name").val(); 
            var last_name = $("#last_name").val();
            var email = $("#email").val();
            var contact_no = $("#contact_no").val();
            var post_apply_for = $("#post_apply_for").val();
            var business_id = $("#business_id").val();
            var showroom_id = $("#showroom_id").val();
            var service_center_id = $("#service_center_id").val();
            var body_shop_id = $("#body_shop_id").val();
            var resume = $('#resume').prop('files')[0];   

            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
            formData.append('email', email);
            formData.append('contact_no', contact_no);
            formData.append('post_apply_for', post_apply_for);
            formData.append('business_id', business_id);
            formData.append('showroom_id', showroom_id);
            formData.append('service_center_id', service_center_id);
            formData.append('body_shop_id', body_shop_id);
            formData.append('resume', resume);
            
            //   validation
            if(first_name == '')
            {
                $("#first-name-error").text('First name is required.');
                isValid = false;
            }else{
                $("#first-name-error").text('');
            }

            if(email == '')
            {
                $("#email-error").text('Email is required.');
                isValid = false;
            }else{
                $("#email-error").text('');
            }

            if(contact_no == '')
            {
                $("#contact-error").text('Contact No is required.');
                isValid = false;
            }else{
                $("#contact-error").text('');
            }

            if(isValid) {
                $.ajax({
                    url:"{{ route('job-apply') }}",
                    type: "post",
                    data:formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {
                        if(data.status == 1){
                            toastr.success('Application send successfully!');
                            document.getElementById('career_form').reset();
                        }else{
                            toastr.success('Somthing went wrong!please try again');
                        }
                    }
                });
            }

        });
        // $("#submit").click(function(e){
        //     e.preventDefault();
        //     var isValid = true;
        //     var first_name = $("#first_name").val(); 
        //     last_name = $("#last_name").val();
        //     email = $("#email").val();
        //     contact_no = $("#contact_no").val();
        //     post_apply_for = $("#post_apply_for").val();

        //     var formData = new FormData();
        //     var resume = $('#resume').prop('files')[0];  
        //     formData.append('resume', resume); 

        //     // validation
        //     if(first_name == '')
        //     {
        //         $("#first-name-error").text('First name is required.');
        //         isValid = false;
        //     }else{
        //          $("#first-name-error").text('First name is required.');
        //     }

        //     if(email == '')
        //     {
        //         $("#email-error").text('Email is required.');
        //         isValid = false;
        //     }

        //     if(contact_no == '')
        //     {
        //         $("#contact-error").text('Contact No is required.');
        //         isValid = false;
        //     }

        //     if(isValid) {
        //         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        //         $.ajax({
        //             type:"POST",
        //             dataType: "json",
        //             data:{_token: CSRF_TOKEN,"first_name":first_name,"last_name":last_name,"email":email,"contact_no":contact_no,"post_apply_for":post_apply_for,"resume":resume},
        //             url:"{{ route('job-apply') }}",
        //             processData: false,
        //             success:function(data){
        //                 if(data.status == 1){
        //                     toastr.success('Application send successfully!');
        //                     document.getElementById('career_form').reset();
        //                 }else{
        //                     toastr.success('Somthing went wrong!please try again');
        //                 }
        //             }
        //         });
        //     }
        // });
    });

    const wrapper = document.querySelector(".wrapper");
    const header = document.querySelector(".header");
    localStorage.setItem("image_index",0);
    var link = "{{ url('/public/uploads/vacancy/')}}/";

    wrapper.addEventListener("scroll", (e) => {
        e.target.scrollTop > 30
        ? header.classList.add("header-shadow")
        : header.classList.remove("header-shadow");
    });

    const toggleButton = document.querySelector(".dark-light");

    toggleButton.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");
    });

    const jobCards = document.querySelectorAll(".job-card");
    const logo = document.querySelector(".logo");
    const jobLogos = document.querySelector(".job-logos");
    const jobDetailTitle = document.querySelector(".job-explain-content .job-card-title");
    const jobDetailCompany = document.querySelector(".job-explain-content .job-subtitle-wrapper .company-name .comp-location");
    const jobDetailExperience = document.querySelector(".job-explain-content .experience");
    const jobDetailWorkLevel = document.querySelector(".job-explain-content .work-level");
    const jobDetailEmployeeType = document.querySelector(".job-explain-content .employee-type");
    const jobDetailOfferSalary = document.querySelector(".job-explain-content .offer-salary");

    const jobDetailBusiness = document.querySelector(".job-explain-content .business");
    const jobDetailShowroom = document.querySelector(".job-explain-content .showroom");
    const jobDetailServiceCenter = document.querySelector(".job-explain-content .service_center");
    const jobDetailBodyShop = document.querySelector(".job-explain-content .body_shop");

    // const jobDetailCareerFrom = document.querySelector(".job-explain-content .form-carrer-page");

    const jobBg = document.querySelector(".job-bg");
    jobCards.forEach((jobCard) => {
        console.log(jobCard)
        jobCard.addEventListener("click", () => {
            var imageData = @json($image);
            var image_index = localStorage.getItem("image_index");

            imageData.forEach((data,index) =>  {
                const number = Math.floor(Math.random() * imageData.length);
                const url = link+imageData[image_index].image;
                jobBg.src = url;
                const logo = jobCard.querySelector("img");
                const bg = logo.style.backgroundColor;

                const title = jobCard.querySelector(".job-card-title");
                const company = jobCard.querySelector(".company-name .comp-location");
                const experience = jobCard.querySelector(".experience");
                const worklevel = jobCard.querySelector(".work-level");
                const employeeType = jobCard.querySelector(".employee-type");
                const offerSalary = jobCard.querySelector(".offer-salary");

                const business = jobCard.querySelector(".business");
                const showroom = jobCard.querySelector(".showroom");
                const serviceCenter = jobCard.querySelector(".service_center");
                const bodyshop = jobCard.querySelector(".body_shop");

                jobDetailTitle.textContent = title.textContent;
                jobDetailCompany.textContent = company.textContent;
                jobDetailExperience.textContent = experience.textContent;
                jobDetailWorkLevel.textContent = worklevel.textContent;
                jobDetailEmployeeType.textContent = employeeType.textContent;
                jobDetailOfferSalary.textContent = offerSalary.textContent;

                jobDetailBusiness.textContent = business.textContent;
                jobDetailShowroom.textContent = showroom.textContent;
                jobDetailServiceCenter.textContent = serviceCenter.textContent;
                jobDetailBodyShop.textContent = bodyshop.textContent;

                jobLogos.innerHTML = logo.outerHTML;
                wrapper.classList.add("detail-page");
                wrapper.scrollTop = 0;
            });
            image_index++;
            if(imageData.length ==image_index) {
                localStorage.setItem("image_index",0);
            } else{
                localStorage.setItem("image_index",image_index);
            }
        });
    });
</script>
@endsection
