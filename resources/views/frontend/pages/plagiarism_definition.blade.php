@extends('frontend.layouts.default')

@section('title', 'Plagiarism Definition')
@section('description', "Plagiarism Definition")

@section('content')

 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Plagiarism Definition</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>Plagiarism Definition</span></p>
          </div>
        </div>
      </div>
    </div>  

    

    <div class="site-section">
      <div class="container">
          <div class="row mb-9">
              @include('frontend.home.fileuploadtemplate')
          </div>
        <div class="mb-9 ml-auto" data-aos="fade" >
          <p class="mb-5">
            Academic writing is a real challenge that requires creativity and innovation. Words represent the originality of thoughts, ideas and messages. However, originality is not entirely possible without ending up using some words that may exceed the limit towards plagiarism that is unacceptable. Don’t worry, it is not that hard anymore to work without being sure of where you stand on the plagiarism line. This is why you need a plagiarism checker <a href = "{{ $pages[array_keys($pages)[0]] }}">{{ array_keys($pages)[0] }}</a>, especially for students who need a similarity checker for everyday assignments. 
          </p>
          <div class="text-center pb-1 border-primary mb-3">
              <h2 class="text-primary">Definitions of Plagiarism</h2>
          </div>
          <p>
              So, what exactly is plagiarism?<br/>
              Wikipedia defines plagiarism as the 'wrongful appropriation' and 'stealing and publication' of another author's 'language, thoughts, ideas, or expressions' and the representation of them as one's own original work." This means that plagiarism can be seen as using someone else's original idea or material without explicitly crediting them as the authentic owner.<br/>
              Similarly, according to the renowned Merriam-Webster dictionary, to plagiarize means "to steal and pass off (the ideas or words of another person) as one's own or to use (another's production) without crediting the source <a href = "{{ $pages[array_keys($pages)[1]] }}">{{ array_keys($pages)[1] }}</a>." Simply put, plagiarism is a fraudulent act, which involves stealing someone else's work and passing it off as your own.<br/>
              Just like original inventions are usually patented, original ideas, also called intellectual properties, are often protected by copyright laws, which grant the exclusive rights to publish and replicate such works to the respective copyright holders.<br/>
              In the same vein, Dictionary.com defines plagiarism as "an act or instance of using or closely imitating the language and thoughts of another author without authorization and the representation of that author's work as one's own, as by not crediting the original author." This also implies that imitation and theft of another author's thoughts, ideas and statements without proper referencing and citation amounts to plagiarism.<br/>
              Other instances of plagiarism include copying someone else's work word-for-word – also called lifting, failing to enclose an excerpt in quotation marks, giving false information about the source of a quotation or copying so many words or statements from a particular source, such that it forms the majority of your own work <a href = "{{ $pages[array_keys($pages)[2]] }}">{{ array_keys($pages)[2] }}</a>, whether you cite the source or not. Quite simply, every one that intends to write must firstly learn how to summarize, include his ideas, and write in his own words, after thorough reading and researching for a written work. <br/>
              Furthermore, several other acts that amount to plagiarism include using a still image, motion picture or piece of music in a work you have produced without receiving proper authorization from the original author or content owner, or refusal to appropriately credit the author. “Plagiarism often covers things that are not covered by copyright – ideas, facts and general plot elements are all things that can be plagiarized, at least in certain situations, but generally don’t qualify for copyright protection” (Bailey, 2013).<br/>
              Experts advise that the best alternative to avoid plagiarism is getting adequate research knowledge and the mastery of effective writing skills. To avoid plagiarism, one must ensure the full reference details of every source used is written in one’s notes while reading and researching for a written work. It is important for writers to learn how to paraphrase, quote, and to properly cite and reference cited materials.
              
          </p>

         
      </div>
    </div>
  </div>

@stop