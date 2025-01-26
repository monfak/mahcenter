@extends('frontend.layouts.app')
@section('title', 'سوالات متداول')
@section('description', 'سوالات متداول مه سنتر')
@section('seo')
    <meta name="keywords" content="سوالات متداول,سوالات متداول">
@endsection
@section('styles')
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
    <style>
        .myaccordion {
  max-width: 500px;
  margin: 50px auto;
  box-shadow: 0 0 1px rgba(0,0,0,0.1);
}

.myaccordion .card,
.myaccordion .card:last-child .card-header {
  border: none;
}

.myaccordion .card-header {
  border-bottom-color: #EDEFF0;
  background: transparent;
}

.myaccordion .fa-stack {
  font-size: 18px;
}

.myaccordion .btn {
  width: 100%;
  font-weight: bold;
  color: #004987;
  padding: 0;
}

.myaccordion .btn-link:hover,
.myaccordion .btn-link:focus {
  text-decoration: none;
}

.myaccordion li + li {
  margin-top: 10px;
}
    </style>
@endsection
@section('content')
<div class="content-body question-01">
    <div class="container">
	    <h1 class="title-page">  سوالات متداول</h1>
	    <div id="accordion" class="myaccordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="d-flex align-items-center justify-content-between btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Undergraduate Studies
                  <span class="fa-stack fa-sm">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fas fa-minus fa-stack-1x fa-inverse"></i>
                  </span>
                </button>
              </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <ul>
                  <li>Computer Science</li>
                  <li>Economics</li>
                  <li>Sociology</li>
                  <li>Nursing</li>
                  <li>English</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Postgraduate Studies
                  <span class="fa-stack fa-2x">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                  </span>
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body">
                <ul>
                  <li>Informatics</li>
                  <li>Mathematics</li>
                  <li>Greek</li>
                  <li>Biostatistics</li>
                  <li>English</li>
                  <li>Nursing</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header" id="headingThree">
              <h2 class="mb-0">
                <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Research
                  <span class="fa-stack fa-2x">
                    <i class="fas fa-circle fa-stack-2x"></i>
                    <i class="fas fa-plus fa-stack-1x fa-inverse"></i>
                  </span>
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <div class="card-body">
                <ul>
                  <li>Astrophysics</li>
                  <li>Informatics</li>
                  <li>Criminology</li>
                  <li>Economics</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>	
<script>
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
  $(e.target)
    .prev()
    .find("i:last-child")
    .toggleClass("fa-minus fa-plus");
});

</script>
@endsection
