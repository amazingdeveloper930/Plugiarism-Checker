@extends('backend.user.layouts.default')
@section('title', 'Plagiarismchecker | Price Of Plagiarism Check')
@section('description', "Plagiarismchecker | Price Of Plagiarism Check")
@section('content')

<div class="card">
                <div class="card-header card-header-warning card-header-icon">
            	<div class="card-icon">
                    <i class="material-icons">attach_money</i>
                  </div>
                  <h4 class="card-title ">Price</h4>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-warning">
                        <tr><th>
                          ID
                        </th>
                        <th>
                          File Type
                        </th>
                        <th class="text-center">
                          Word Count
                        </th>
                        <th>
                          Price
                        </th>
                      </tr></thead>
                      <tbody>
                        <tr>
                          <td>
                            1
                          </td>
                          <td>
                            Microsoft Office Word - *.docx
                          </td>
                          <td class="text-center">
                            < 100
                          </td>
                          <td class="text-warning">
                            $ 10
                          </td>
                        </tr>
                        <tr>
                          <td>
                            2
                          </td>
                          <td>
                            Microsoft Office Word - *.docx
                          </td>
                          <td class="text-center">
                            100 <
                          </td>
                          <td class="text-warning">
                            $ 10 / 100 words
                          </td>
                        </tr>
                        <tr>
                          <td>
                            3
                          </td>
                          <td>
                            Pdf File - *.pdf
                          </td>
                          <td class="text-center">
                            < 100
                          </td>
                          <td class="text-warning">
                            $ 10
                          </td>
                        </tr>
                        <tr>
                          <td>
                            4
                          </td>
                          <td>
                            Pdf File - *.pdf
                          </td>
                          <td class="text-center">
                            100 <
                          </td>
                          <td class="text-warning">
                            $ 10 / 100 words
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

@stop