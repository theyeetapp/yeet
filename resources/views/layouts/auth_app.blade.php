
@extends('layouts/app')

@section('title')
    {{ $title }}
@endsection

@section('body')
    <div class='w-screen min-h-screen grid grid-cols-12 bg-light-gray work-sans'>
        <div class='col-span-2 h-full bg-yeet-blue flex flex-col py-8 px-5 text-white'>
            <div class='py-5 w-full flex flex-row items-center px-4 mb-12'>
                <i class='relative fa fa-home text-sm mr-5' style='bottom:1px'></i>
                <p class='m-0 text-sm'>yeet</p>
            </div>
            <ul class='text-light-gray px-4'>
                <li class='mb-5 text-sm'>pages</li>
                <li class='flex flex-row items-center mb-8'>
                    <i class='fa fa-check-circle mr-5'></i>
                    <a href='/' class='text-sm'>subscriptions</a>
                </li>
                <li class='flex flex-row items-center mb-8'>
                    <i class='fa fa-coins mr-5'></i>
                    <a href='/' class='text-sm'>stocks</a>
                </li>
                <li class='flex flex-row items-center mb-8'>
                    <i class='fab fa-bitcoin mr-5'></i>
                    <a href='/' class='text-sm'>crypto</a>
                </li>
            </ul>
            <ul class='px-4'>
                <li class='mb-5 text-sm'>actions</li>
                <li class='relative flex flex-row items-center mb-8' style='left:1px'>
                    <i class='fa fa-image mr-5'></i>
                    <a href='/' class='text-sm'>change avatar</a>
                </li>
                <li class='relative flex flex-row items-center' style='left:1px'>
                    <i class='fa fa-sign-out-alt mr-5'></i>
                    <a href='/' class='text-sm'>logout</a>
                </li>
            </ul>
        </div>
    </div>
@endsection