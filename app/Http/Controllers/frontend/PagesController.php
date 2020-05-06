<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function getBackLinks_part1($count)
    {
        $pages = array(
            'Online plagiarism checker' => route('pages.online_checker'),
            'Similarity checker' => route('pages.similarity_checker'),
            'Plagiarism checker' => route('pages.plagiarism_checker'),
            'Plagiarism detection' => route('pages.plagiarism_detection'),
            'Plagiarism definition' => route('pages.plagiarism_definition'),
            'Copyright checker' => route('pages.copyright_checker'),
            'Google plagiarism checker' => route('pages.google_checker'),
            'Plagiarism scanner' => route('pages.plagiarism_scanner')
        );
        $key = array(
            'Online plagiarism checker',
            'Similarity checker',
            'Plagiarism checker',
            'Plagiarism detection',
            'Plagiarism definition',
            'Copyright checker',
            'Google plagiarism checker',
            'Plagiarism scanner'
        );
        shuffle($key);
        $backlinkpages = array();
        for($index = 0; $index < $count; $index ++)
        {
            $backlinkpages[$key[$index]] = $pages[$key[$index]];
        }
        return $backlinkpages;
    }

    public function getBackLinks_part2($count)
    {
        $pages = array(
            'Examples of plagiarism' => route('pages.plagiarism_example'),
            'Plagiarism checker for students' => route('pages.checker_students'),
            'Plagiarism detector' => route('pages.plagiarism_detector'),
            'Blog' => route('pages.blog')
        );
        $key = array(
            'Examples of plagiarism',
            'Plagiarism checker for students',
            'Plagiarism detector',
            'Blog'
        );
        shuffle($key);
        $backlinkpages = array();
        for($index = 0; $index < $count; $index ++)
        {
            $backlinkpages[$key[$index]] = $pages[$key[$index]];
        }
        return $backlinkpages;
    }

    public function getBackLinks_old()
    {
        $pages = array(
            'Online plagiarism checker' => route('pages.online_checker'),
            'Similarity checker' => route('pages.similarity_checker'),
            'Plagiarism checker' => route('pages.plagiarism_checker'),
            'Plagiarism detection' => route('pages.plagiarism_detection'),
            'Plagiarism definition' => route('pages.plagiarism_definition'),
            'Copyright checker' => route('pages.copyright_checker'),
            'Google plagiarism checker' => route('pages.google_checker'),
            'Plagiarism scanner' => route('pages.plagiarism_scanner')
        );
        $key = array(
            'Online plagiarism checker',
            'Similarity checker',
            'Plagiarism checker',
            'Plagiarism detection',
            'Plagiarism definition',
            'Copyright checker',
            'Google plagiarism checker',
            'Plagiarism scanner'
        );
        $backlinkpages = array();
        $index1= rand(0, 5);
        $index2= $index1 + rand(1, 5);
        $index3= $index2 + rand(1, 5);
        $backlinkpages[$key[$index1]] = $pages[$key[$index1]];
        if($index2 >= count($pages))
            return $backlinkpages;
        $backlinkpages[$key[$index2]] = $pages[$key[$index2]];
    
        if($index3 >= count($pages))
            return $backlinkpages;
        $backlinkpages[$key[$index3]] = $pages[$key[$index3]];
        return $backlinkpages;
    }
    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function plagiarism()
    {
        return view('frontend.pages.plagiarism');
    }

    public function blog()
    {
      
        return view('frontend.pages.blog', ['pages' => $this -> getBackLinks_part1(2)]);
    }

    public function terms()
    {
        return view('frontend.pages.terms');
    }

    public function partners()
    {
        return view('frontend.pages.partners');
    }

    public function plagiarism_checker()
    {
        return view('frontend.pages.plagiarism_checker', ['pages' => $this -> getBackLinks_part2(3)]);
    }
    public function plagiarism_detection()
    {
        return view('frontend.pages.plagiarism_detection', ['pages' => $this -> getBackLinks_part2(3)]);
    }
    public function plagiarism_definition()
    {
        return view('frontend.pages.plagiarism_definition', ['pages' => $this -> getBackLinks_part2(3)]);
    }
    public function plagiarism_detector()
    {
       
        return view('frontend.pages.plagiarism_detector', ['pages' => $this -> getBackLinks_part1(2)]);
    }
    public function copyright_checker()
    {
        return view('frontend.pages.copyright_checker', ['pages' => $this -> getBackLinks_part2(3)]);
    }
    public function checker_students()
    {
        return view('frontend.pages.checker_students',  ['pages' => $this -> getBackLinks_part1(3)]);
    }
    public function checker_universities()
    {
        return view('frontend.pages.checker_universities');
    }
    public function checker_business()
    {
        return view('frontend.pages.checker_business');
    }
    public function similarity_checker()
    {
        return view('frontend.pages.similarity_checker', ['pages' => $this -> getBackLinks_part2(3)]);
    }
    public function google_checker()
    {
        return view('frontend.pages.google_checker', ['pages' => $this -> getBackLinks_part2(3)]);
    }
    public function online_checker()
    {
        return view('frontend.pages.online_checker', ['pages' => $this -> getBackLinks_part2(3)]);
    }
    public function plagiarism_scanner()
    {
        return view('frontend.pages.plagiarism_scanner', ['pages' => $this -> getBackLinks_part2(3)]);
    }
    public function plagiarism_example()
    {
        return view('frontend.pages.plagiarism_example',  ['pages' => $this -> getBackLinks_part1(3)]);
    }

    public function calc_universities()
    {
        return view('frontend.pages.calc_universities');   
    }


}
