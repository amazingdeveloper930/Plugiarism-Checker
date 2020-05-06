@extends('frontend.layouts.default')

@section('title', 'Plagiarism Detection')
@section('description', "Plagiarism Detection")

@section('content')

 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Plagiarism Detection</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>Plagiarism Detection</span></p>
          </div>
        </div>
      </div>
    </div>  

    

    <div class="site-section">
      <div class="container">
          <div class="row mb-9">
              @include('frontend.home.fileuploadtemplate')
          </div>
        <div class="row mb-9 ml-auto" data-aos="fade" >
          <p>
            With the “multilingual detection”, our free online plagiarism checker for students is capable of identifying plagiarism for several different languages which is why Plagiarismchecker.eu is known as the national best plagiarism checker system in more of the countries. The online editing is another sign of relief for those who wish to go for a quick check without having to download an entire similarity checker that may take up more space in your computer. This also means there is no need for resubmissions and fee and you get your document checked without the format being affected at all. The upload feature is simplified for further convenience where you have to merely click upload or drag your file to the box from anywhere, anytime- it is just that simple!
          </p>
          <div class="text-center pb-1 border-primary mb-5">
              <h2 class="text-primary">Protect Your Publication with a Plagiarism Report</h2>
          </div>
          <p>The internet has made it easy for anyone to copy another’s work and pass it off as their own. Lecturers and university professors must remain diligent to ensure that every student is following the rules. Professional bloggers need to be constantly on the lookout for other bloggers who may be scraping their content, and students need to protect themselves against accusations of plagiarism.</p>
          <p>Software is available online which can help anyone who regularly publishes content to protect their work via way of a plagiarism report. Lecturers can use the feature to check that their students are not cheating, and bloggers can use a plagiarism report to discover bloggers who may be using their content illegally. </p>
          <p>Plagiarism <a href = "{{ $pages[array_keys($pages)[0]] }}">{{ array_keys($pages)[0] }}</a> is a practice which should be taken seriously by anybody who regularly publishes content, or who is responsible for publishing the works of others. If you inadvertently publish plagiarized content or hand in a plagiarized paper, you could have legal proceedings brought against you, be expelled from your school, college, or university, or have your reputation irreparably tarnished.</p>
          <p>The Growing Importance of Online Plagiarism Checkers</p>
          <p>An online plagiarism report provides safeguards should you have any issues with copied content. When you can produce a plagiarism report stating that your work is unique you can protect your reputation.</p>
          <p>Tools which can create plagiarism reports for you are available online. University and college students can check their work against hundreds of scientific databases, but business bloggers and news websites can also benefit from the service. </p>
          <p>Whether you need to check one document or hundreds, a plagiarism report can make all the difference when it comes time to hand in your paper or publish your content online. Knowing that your work is 100% is one thing but knowing that you can also prove it through a plagiarism report can provide peace of mind. </p>
      </div>
    </div>
  </div>

@stop