@extends('frontend.layouts.default')

@section('title', 'Similarity Checker')
@section('description', "Similarity Checker")
@section('content')

 <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(images/hero_bg_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
            <h1 class="text-white font-weight-light text-uppercase font-weight-bold">Similarity Checker</h1>
            <p class="breadcrumb-custom"><a href="{{ route('home')}}">The checker</a> <span class="mx-2">&gt;</span> <span>Similarity Checker</span></p>
          </div>
        </div>
      </div>
    </div>  

    

    <div class="site-section">
      <div class="container">
          <div class="row mb-9">
              @include('frontend.home.fileuploadtemplate')
          </div>
        <div class=" mb-9 ml-auto" data-aos="fade" >

          <div class="text-center pb-1 mb-3">
              <h3 class="text-primary">Similarity checker or plagiarism checker - is there any difference?</h3>
          </div>
          <p class="mb-5">
           One thing that needs to be clarified is that the users must not confuse plagiarism <a href = "{{ $pages[array_keys($pages)[0]] }}">{{ array_keys($pages)[0] }}</a> and similarities to be any different. Copying or using the exact words of other writers is both similar and plagiarized. These similarities also include citations and anything that is outside the quotes. We help you identify the ‘real deals’ and remove the fake and valueless words that fall in the premises of plagiarism. We go through all your work and see every comma, sentence and text for any non-original text that can be changed.
          </p>

           <div class="text-center pb-1 mb-3">
              <h3 class="text-primary">Copyright Infringement</h3>
          </div>
          <p class="mb-5">
          Copyright infringement refers to a situation where someone utilizes the copyrighted work (such as a book, an article, a song, still or motion picture, etc.) which originally belongs to someone else without proper permission for the usage of such a document or file (sometimes, the terms "piracy" and "theft" are used interchangeably with copyright infringement even though they can have different contextual meanings).<br/>
When a particular body of work or material is protected by copyright laws, the exclusive right to reproduce, distribute, display or perform the protected work or replicate that original property is granted to the creator of the work and such a person becomes the copyright holder <a href = "{{ $pages[array_keys($pages)[1]] }}">{{ array_keys($pages)[1] }}</a>. Although as a general rule, one is on safe ground if one uses a small part of someone’s work for the benefit of the public and in a non-competitive way. It is however important to remind that if you use a large part of someone’s work for commercial use, then the rule does not favor you.  Sometimes, the copyright holder may also be the publisher of the work or someone else to whom the creator of the work has legally transferred the rights. Hence, one needs to obtain the prior permission of the copyright holder before that copyrighted work can be distributed, sold or replicated. “Many users wrongly assume, especially with regard to Internet-delivered resources, that if there is no prominent copyrighting notice on an item, then the item is not copyrighted” (Colyer, 1997).<br/>
Also, the term "piracy" has been used to describe the unauthorized copying and distribution of copyrighted works. Also, in simpler terms, piracy has been defined as the act of illegally copying someone's product or invention without prior permission. This is seen as an infringement of copyright laws and is a punishable offence under the law. Traditionally, piracy is used to describe acts of copyright infringement intentionally committed for the purpose of monetary gain, but more recently, copyright holders are raising a brow about a phenomenon called "online copyright infringement" where files are illicitly distributed or shared over web platforms against the wish of the copyright holder and contrary to the rule of fair use <a href = "{{ $pages[array_keys($pages)[2]] }}">{{ array_keys($pages)[2] }}</a>.<br/>
Similar to piracy, theft is a more encompassing term that copyright owners use to describe the unlawful use of their copyrighted material by others. This unlawful use means that permission for redistribution was not granted and/or authorization for use was not given by the copyright holder. There are still varying definitions of copyright infringement, theft and privacy in the legal circle though, but all of these acts are punishable under the copyright laws and attract legal sanctions.

          </p>
          <br/>
          <p>
            Works Cited - Copyright Law, the Internet, and Distance Education. <br/>
            Retrieved from <a href = "http://web.worldbank.org/archive/website00236B/WEB/COPY_01.HT">http://web.worldbank.org/archive/website00236B/WEB/COPY_01.HT</a>
          
          </p>
         
      </div>
    </div>
  </div>

@stop