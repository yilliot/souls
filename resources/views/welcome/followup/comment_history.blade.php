@extends('welcome.layout')

@section('title')
  Comment History
@endsection

@include('welcome.parts.navigation_bar')

@section('content')

<table class="ui table">
  <thead>
    <tr class="content" style="display: flex !important; justify-content: space-between !important;">
      <th class="header w-100">
        Comment History (5)
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="">
        <div class="mb-3">28/04/2018 3:50pm</div>
        <p class="width-md-comment-history width-lg-comment-history" style="word-break: break-word; white-space: pre-line;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, ad odio! Eos distinctio possimus nihil omnis amet quis labore, magnam minima eaque dicta, optio error pariatur eius, quisquam, eveniet deleniti?</p>
      </td>
    </tr>
    <tr>
      <td class="">
        <div class="mb-3">28/04/2018 3:50pm</div>
        <p class="width-md-comment-history width-lg-comment-history" style="word-break: break-word; white-space: pre-line;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, ad odio! Eos distinctio possimus nihil omnis amet quis labore, magnam minima eaque dicta, optio error pariatur eius, quisquam, eveniet deleniti?</p>
      </td>
    </tr>
    <tr>
      <td class="">
        <div class="mb-3">28/04/2018 3:50pm</div>
        <p class="width-md-comment-history width-lg-comment-history" style="word-break: break-word; white-space: pre-line;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, ad odio! Eos distinctio possimus nihil omnis amet quis labore, magnam minima eaque dicta, optio error pariatur eius, quisquam, eveniet deleniti?</p>
      </td>
    </tr>
    <tr>
      <td class="">
        <div class="mb-3">28/04/2018 3:50pm</div>
        <p class="width-md-comment-history width-lg-comment-history" style="word-break: break-word; white-space: pre-line;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, ad odio! Eos distinctio possimus nihil omnis amet quis labore, magnam minima eaque dicta, optio error pariatur eius, quisquam, eveniet deleniti?</p>
      </td>
    </tr>
    <tr>
      <td class="">
        <div class="mb-3">28/04/2018 3:50pm</div>
        <p class="width-md-comment-history width-lg-comment-history" style="word-break: break-word; white-space: pre-line;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, ad odio! Eos distinctio possimus nihil omnis amet quis labore, magnam minima eaque dicta, optio error pariatur eius, quisquam, eveniet deleniti?</p>
      </td>
    </tr>  
  </tbody>
  <tbody style="display: none !important;">
    <tr style="display: none!important;">
      <td style="display: none!important;">
        No services, change filter or come back later
      </td>
    </tr>
  </tbody>  
</table>       

  <div style="display: flex; justify-content: center;">
    <a role="button" href="/followup/" class="ui black deny button mb-5">
      OK
    </a>
  </div>

@endsection