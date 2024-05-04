@extends('frontend.layout.header')
@section('css')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
<style>
    .navigation .navbar .dropdown-item::before {position: absolute; content: ''; left: 0px !important;}
    th {background-color:#4D525B; color:#fff !important; border: 0 !important;}
    table{width: 100%;}
    .btn-primary {background-color: #ec3237; border-color: #ec3237; color: #fff;}
   
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
    .logo svg {
    width: 24px;
    margin-right: 12px;
    }

    .user-settings {
    display: flex;
    align-items: center;
    font-weight: 500;
    }
    .user-settings svg {
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
    .job-overview .overview-wrapper svg:first-child {
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
    .job-logos svg {
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
        <img src="assets/image/Careers.svg" alt="">
    </div>
</section>

<section class="about-cards-section" style="margin-top:20px;">
    <div class="container">
        <div class="carrer-offer">
            <h2>What We Offer?</h2>
        </div>
        <div class="row">
            <div class="col-sm-4 card-wrapper">
                <div class="card border-0">
                    <div class="position-relative rounded-circle overflow-hidden mx-auto custom-circle-image">
                        <img class="w-100 h-100" src="assets/image/sound.png" alt="Card image cap">
                    </div>
                    <div class="card-body text-center mt-4">
                        <h3 class=" card-title" style="font-size: 1.4em;color: #e52334;"> Everyone has a Voice</h3>
                        <p class="qq">The Sachdev Group is committed to providing an open environment for creativity, ideas, and innovation.</p>
                    </div>
                </div>
            </div>
    
            <div class="col-sm-4 card-wrapper">
                <div class="card border-0">
                    <div class="position-relative rounded-circle overflow-hidden mx-auto custom-circle-image">
                        <img class="w-100 h-100" src="assets/image/growth.png" alt="Card image cap">
                    </div>
                    <div class="card-body text-center mt-4">
                        <h3 class="card-title" style="font-size: 1.4em;color: #e52334;">Room to Grow</h3>
                        <p class="qq">Grow on your career path with exciting learning opportunities at The Sachdev Group.</p>
                    </div>
                </div>
            </div>
    
            <div class="col-sm-4 card-wrapper">
                <div class="card border-0">
                    <div class="position-relative rounded-circle overflow-hidden mx-auto custom-circle-image">
                        <img class="w-100 h-100" src="assets/image/positive.png" alt="Card image cap">
                    </div>
                    <div class="card-body text-center mt-4">
                        <h3 class="card-title" style="font-size: 1.4em;color: #e52334;">Positivity is a Value</h3>
                        <p class="qq">We provide a positive and inclusive environment to help you achieve your goals with us.</p>
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
                    <h3>Join Us</h3>  
                    <h2>Current Vacancies</h2> 
                </div>
            </div>
        </div>  
    </div>
    <div class="wrapper">
        <div class="main-container">
            <div class="searched-jobs">
                <div class="job-cards">
                    <div class="job-card">
                        <div class="job-card-header">
                            <svg viewBox="0 -13 512 512" xmlns="http://www.w3.org/2000/svg" style="background-color:#2e2882">
                                <g fill="#feb0a5">
                                    <path d="M256 92.5l127.7 91.6L512 92 383.7 0 256 91.5 128.3 0 0 92l128.3 92zm0 0M256 275.9l-127.7-91.5L0 276.4l128.3 92L256 277l127.7 91.5 128.3-92-128.3-92zm0 0" />
                                    <path d="M127.7 394.1l128.4 92 128.3-92-128.3-92zm0 0" />
                                </g>
                                <path d="M512 92L383.7 0 256 91.5v1l127.7 91.6zm0 0M512 276.4l-128.3-92L256 275.9v1l127.7 91.5zm0 0M256 486.1l128.4-92-128.3-92zm0 0" fill="#feb0a5" />
                            </svg>
                            <div class="menu-dot"></div>
                        </div>
                        <div class="job-card-title">Automotive Technician</div>
                        <div class="job-card-subtitle">An automotive technician will diagnose and repair vehicle issues, perform maintenance tasks, and ensure vehicles meet safety and performance standards.</div>
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
                    <div class="job-card">
                        <div class="job-card-header">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" style="background-color:#f76754">
                                <path xmlns="http://www.w3.org/2000/svg" d="M0 .5h4.2v23H0z" fill="#042b48" data-original="#212121" />
                                <path xmlns="http://www.w3.org/2000/svg" d="M15.4.5a8.6 8.6 0 100 17.2 8.6 8.6 0 000-17.2z" fill="#fefefe" data-original="#f4511e" />
                            </svg>
                            <div class="menu-dot"></div>
                        </div>
                        <div class="job-card-title">Sales Associate</div>
                        <div class="job-card-subtitle">A sales associate will engage with customers, assist in vehicle selection, provide information on features and financing, and facilitate test drives.</div>
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
                </div>
                <div class="job-overview">
                    <div class="job-overview-cards">
                        <div class="job-overview-card">
                            <div class="job-card overview-card">
                                <div class="overview-wrapper">
                                    <svg viewBox="0 -13 512 512" xmlns="http://www.w3.org/2000/svg" style="background-color:#2e2882">
                                        <g fill="#feb0a5" >
                                            <path d="M256 92.5l127.7 91.6L512 92 383.7 0 256 91.5 128.3 0 0 92l128.3 92zm0 0M256 275.9l-127.7-91.5L0 276.4l128.3 92L256 277l127.7 91.5 128.3-92-128.3-92zm0 0" />
                                            <path d="M127.7 394.1l128.4 92 128.3-92-128.3-92zm0 0" />
                                        </g>
                                        <path d="M512 92L383.7 0 256 91.5v1l127.7 91.6zm0 0M512 276.4l-128.3-92L256 275.9v1l127.7 91.5zm0 0M256 486.1l128.4-92-128.3-92zm0 0" fill="#feb0a5" />
                                    </svg>
                                    <div class="overview-detail">
                                        <div class="job-card-title">UI / UX Designer</div>
                                        <div class="job-card-subtitle">Moti Nagar</div>
                                    </div>
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
                        <div class="job-overview-card">
                            <div class="job-card overview-card">
                                <div class="overview-wrapper">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" style="background-color:#f76754">
                                        <path xmlns="http://www.w3.org/2000/svg" d="M0 .5h4.2v23H0z" fill="#042b48" data-original="#212121" />
                                        <path xmlns="http://www.w3.org/2000/svg" d="M15.4.5a8.6 8.6 0 100 17.2 8.6 8.6 0 000-17.2z" fill="#fefefe" data-original="#f4511e" /></svg>
                                    <div class="overview-detail">
                                    <div class="job-card-title">Sr. Product Designer</div>
                                    <div class="job-card-subtitle">Moti Nagar</div>
                                </div>
                                <svg class="heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z" /></svg>
                            </div>
                            <div class="job-overview-buttons">
                                <div class="search-buttons time-button">Full Time</div>
                                <div class="search-buttons level-button">Senior Level</div>
                                <div class="job-stat">New</div>
                                <div class="job-day">4d</div>
                            </div>
                        </div>
                    </div>
                    <div class="job-overview-card">
                        <div class="job-card overview-card">
                            <div class="overview-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff" style="background-color:#55acee">
                                    <path d="M512 97.2c-19 8.4-39.3 14-60.5 16.6 21.8-13 38.4-33.4 46.2-58a209.8 209.8 0 01-66.6 25.4A105 105 0 00249.5 153c0 8.3.8 16.3 2.5 24A297.1 297.1 0 0135.6 67 105.1 105.1 0 0068 207.4c-16.9-.3-33.4-5.2-47.4-12.9v1.1c0 51 36.4 93.4 84 103.2-8.5 2.3-17.8 3.4-27.4 3.4-6.8 0-13.5-.3-20-1.8a106 106 0 0098.2 73.2A211 211 0 010 416.9 295.5 295.5 0 00161 464c193.2 0 298.8-160 298.8-298.7 0-4.6-.2-9.1-.4-13.6A209.4 209.4 0 00512 97.2z" /></svg>
                                    <div class="overview-detail">
                                        <div class="job-card-title">User Experience Designer</div>
                                        <div class="job-card-subtitle">Moti Nagar</div>
                                    </div>
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
                    <div class="job-overview-card">
                        <div class="job-card overview-card">
                            <div class="overview-wrapper">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#fff" style="background-color:#1e1f26">
                                    <path d="M24 7.6c0-.3 0-.5-.4-.6C12.2.2 12.4-.3 11.6 0 3 5.5.6 6.7.2 7.1c-.3.3-.2.8-.2 8.3 0 .9 7.7 5.5 11.5 8.4.4.3.8.2 1 0 11.2-8 11.5-7.6 11.5-8.4V7.6zm-1.5 6.5l-3.9-2.4L22.5 9zm-5.3-3.2l-4.5-2.7V2L22 7.6zM12 14.5l-3.9-2.7L12 9.5l3.9 2.3zm-.8-12.4v6L6.8 11 2.1 7.6zm-5.8 9.6l-3.9 2.4V9zm1.3 1l4.5 3.1v6l-9-6.3zm6 9.1v-6l4.6-3.1 4.6 2.8z" />
                                </svg>
                                <div class="overview-detail">
                                    <div class="job-card-title">Product Designer</div>
                                    <div class="job-card-subtitle">Moti Nagar</div>
                                </div>
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
                    <div class="job-overview-card">
                        <div class="job-card overview-card">
                            <div class="overview-wrapper">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="background-color:#ffe80f">
                                    <path d="M9.5 9.3l-.7 2h1.4z" />
                                    <path d="M12 1C5.4 1 0 5.2 0 10.4c0 3.4 2.2 6.3 5.6 8-1.3 4.4-1.3 4.4-1 4.6.2.1.5 0 5.3-3.4l2.1.2c6.6 0 12-4.2 12-9.4S18.6 1 12 1zM6 13c0 .4-.3.7-.6.7s-.7-.3-.7-.7V9H3.6c-.4 0-.7-.4-.7-.7s.3-.7.7-.7H7c.4 0 .7.3.7.7s-.3.6-.7.6h-1zm5.4.7c-.7 0-.6-.6-.9-1.2h-2c-.4.6-.3 1.2-1 1.2s-.8-.4-.6-1.1l1.6-4.3a1 1 0 011-.7c.4 0 .8.3.9.7 1 3.4 2.6 5.4 1 5.4zm4-.1h-2.2c-1.2 0-.5-1.6-.7-5.3 0-.4.3-.7.7-.7s.7.3.7.7v4h1.5c.3 0 .6.3.6.6 0 .4-.3.7-.6.7zm5.4-.5l-.3.4c-1 .7-1.6-1.4-2.6-2.3l-.2.3V13c0 .4-.3.7-.7.7a.7.7 0 01-.7-.7V8.3a.7.7 0 011.4 0v1.5c1.3-1 2-2.7 2.8-2 .8.9-.9 1.6-1.5 2.5 1.6 2.2 1.9 2.3 1.8 2.8z" />
                                </svg>
                                <div class="overview-detail">
                                    <div class="job-card-title">UI / UX Designer</div>
                                        <div class="job-card-subtitle">Moti Nagar</div>
                                    </div>
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
                    </div>
                    <div class="job-explain">
                        <img class="job-bg" alt="">
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
                                <div class="company-name">Galaxy Toyota <span class="comp-location">Moti Nagar, ND.</span></div>
                                <div class="posted">Posted 8 days ago<span class="app-number">98 Application</span></div>
                            </div>
                            <div class="explain-bar">
                                <div class="explain-contents">
                                    <div class="explain-title">Experience</div>
                                    <div class="explain-subtitle">Minimum 1 Year</div>
                                </div>
                                <div class="explain-contents">
                                    <div class="explain-title">Work Level</div>
                                    <div class="explain-subtitle">Senior level</div>
                                </div>
                                <div class="explain-contents">
                                    <div class="explain-title">Employee Type</div>
                                    <div class="explain-subtitle">Full Time Jobs</div>
                                </div>
                                <div class="explain-contents">
                                    <div class="explain-title">Offer Salary</div>
                                    <div class="explain-subtitle">Will be discussed</div>
                                </div>
                            </div>
                            <section id="carrer-form">
                                <div class="container">
                                    <div class="form-carrer-page">
                                        <form>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">First Name</label>
                                                    <input type="text" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Last Name</label>
                                                    <input type="text" class="form-control" id="inputPassword4">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Email Address</label>
                                                    <input type="email" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Contact No.</label>
                                                    <input type="number" class="form-control" id="inputPassword4">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4">Post Applying For</label>
                                                    <input type="text" class="form-control" id="inputEmail4">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4">Upload your Resume</label>
                                                    <input type="file" class="form-control" id="inputPassword4">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Sign in</button>
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
@endsection
@section('javascript')
<script>
    const wrapper = document.querySelector(".wrapper");
    const header = document.querySelector(".header");

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
    const jobBg = document.querySelector(".job-bg");

    jobCards.forEach((jobCard) => {
        jobCard.addEventListener("click", () => {
            const number = Math.floor(Math.random() * 10);
            const url = `https://unsplash.it/640/425?image=${number}`;
            jobBg.src = url;

            const logo = jobCard.querySelector("svg");
            const bg = logo.style.backgroundColor;
            console.log(bg);
            jobBg.style.background = bg;
            const title = jobCard.querySelector(".job-card-title");
            jobDetailTitle.textContent = title.textContent;
            jobLogos.innerHTML = logo.outerHTML;
            wrapper.classList.add("detail-page");
            wrapper.scrollTop = 0;
        });
    });

    logo.addEventListener("click", () => {
        wrapper.classList.remove("detail-page");
        wrapper.scrollTop = 0;
        jobBg.style.background = bg;
    });
</script>
@endsection


























<!--<section id="carrer-form">-->
<!--  <div class="container">-->
<!--  <div class="form-carrer-page">-->
<!--<form>-->
<!--  <div class="form-row">-->
<!--    <div class="form-group col-md-6">-->
<!--      <label for="inputEmail4">First Name</label>-->
<!--      <input type="text" class="form-control" id="inputEmail4">-->
<!--    </div>-->
<!--    <div class="form-group col-md-6">-->
<!--      <label for="inputPassword4">Last Name</label>-->
<!--      <input type="text" class="form-control" id="inputPassword4">-->
<!--    </div>-->
<!--  </div>-->

<!--  <div class="form-row">-->
<!--    <div class="form-group col-md-6">-->
<!--      <label for="inputEmail4">Email Address</label>-->
<!--      <input type="email" class="form-control" id="inputEmail4">-->
<!--    </div>-->
<!--    <div class="form-group col-md-6">-->
<!--      <label for="inputPassword4">Contact No.</label>-->
<!--      <input type="number" class="form-control" id="inputPassword4">-->
<!--    </div>-->
<!--  </div>-->

<!--  <div class="form-row">-->
<!--    <div class="form-group col-md-6">-->
<!--      <label for="inputEmail4">Post Applying For</label>-->
<!--      <input type="text" class="form-control" id="inputEmail4">-->
<!--    </div>-->
<!--    <div class="form-group col-md-6">-->
<!--      <label for="inputPassword4">Upload your Resume</label>-->
<!--      <input type="file" class="form-control" id="inputPassword4">-->
<!--    </div>-->
<!--  </div>-->

 
<!--  <button type="submit" class="btn btn-primary">Sign in</button>-->
<!--</form>-->
<!--</div>-->
<!--</div>-->
<!--</section>-->


<?php
require_once('footer.php'); 

?>















