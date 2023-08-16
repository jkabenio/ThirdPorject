@extends('layouts.admin-app')
@section('content')

<style>
  body {
      margin: 0;
      padding: 0;
      background-color: #1d2634;
      color: #9e9ea4;
      font-family: "Montserrat", sans-serif;
  }
  .main-container {
      grid-area: main;
      overflow-y: auto;
      padding: 20px 20px;
      color: rgba(255, 255, 255, 0.95);
  }
  .grid-container {
      display: grid;
      grid-template-columns: 260px 1fr 1fr 1fr;
      grid-template-rows: 0.2fr 3fr;
      grid-template-areas:
      "sidebar header header header"
      "sidebar main main main";
      height: 100vh;
  }
  .main-title {
      display: flex;
      justify-content: space-between;
  }

  /* Form Style */
  .form-body {
      max-width: 600px;
      margin: 0 auto;
      background-color: #263043;
      padding: 20px;
      border-radius: 5px;
      text-align: center;
  }

  .form-body label {
      display: block;
      margin-top: 10px;
      margin-bottom: 10px;
      color: #9e9ea4;
      font-weight: bold;
      text-align: left;
  }

  .form-body button {
  padding: 10px 20px;
  background-color: #008CBA;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1em;
  }
  .form-control{
      background-color: #1d2634;
      border: 1px solid rgb(124, 124, 124);
      color: white;
  }
  .form-control:focus{
      background-color: #313f55;
      color: rgb(255, 255, 255);
  }
  input[type="file"]::-webkit-file-upload-button {
  padding: 10px 20px;
  background-color: #008CBA;
  margin-bottom: 10px;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1em;
  }

  input {
      display: block;
  }

  #answerHint, #questionHint {
      font-size: 12px;
      color: #ff1e1e;
      margin-bottom: 5px;
  }

  #questionCount, #answerCount{
      font-size: 12px;
      color: #999;
      margin-bottom: 5px;
      float: right;
  }
</style>

<main class="main-container">
    <div class="error">
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
            <div class="alert alert-danger" style="text-align: center">
                {{$error}}
            </div>
            @endforeach
        @endif

        @if(session('success'))
            <div class="alert alert-success" style="text-align: center">
                {{session('success')}}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" style="text-align: center">
                {{session('error')}}
            </div>
        @endif
    </div>
    <h4 class="main-title">Edit FAQs</h4>
    <br><br>
{!! Form::open(['action' => ['App\Http\Controllers\FaqController@updateFAQ',$faqs_id->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    @csrf
    @method('PUT')
    <div class="form-body">
      <div>
        <label class="faqs_label" for="questions">Question</label>
            <div id="questionCount"></div>
            <input type="text" id="questions" class="form-control @error('questions') is-invalid @enderror" name="questions" value="{{$faqs_id->questions}}" required minlength="5" maxlength="100" oninput="updateQuestionCount(this)">
            <span id="questionHint"></span>
      </div> 
      <div>
        <label class="main-title" for="answers">Answer</label>
        <div id="answerCount"></div> 
        <textarea type="text" id="answers" class="form-control @error('answers') is-invalid @enderror" name="answers" rows="10" required minlength="20" maxlength="2000" oninput="updateAnswerCount(this)">{{ old('answers',$faqs_id->answers) }}</textarea>
        <span id="answerHint"></span>
    </div>
        <br>
        <button class="btn btn-primary" type="submit" value="Update">Update</button>
    </div>
{!! Form::close() !!}
</main>
 
@endsection
