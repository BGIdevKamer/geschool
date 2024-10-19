<!DOCTYPE html>
<html>
@include('participant.header')
<style>
    .timerPart {
        position: fixed;
        bottom: 0;
        right: 0;
        background-color: #ffff;
        padding: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }
</style>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        @foreach($Exercice as $exercice)

        <div class="min-height-200px">
            <div class="timerPart">
                <input type="hidden" id="timeInput" value="@if($CountExercice != 0) 00:00:00 @else {{$exercice->duree}} @endif">
                <h4 id="timerDisplay" class="text-primary"></h4>
            </div>
            <div class="p-3 card-box mb-30">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>{{$exercice->libeller}}</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Exercice
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            @if($CountExercice != 0)
            <div class="pd-20 card-box  mb-3">
                <h4 class="text-center text-primary">Vous avez deja traitez cette exerciece</h4>
                <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit esse saepe, possimus deleniti sed labore commodi <br> Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero molestias rem sit natus magnam earum molestiae culpa numquam exercitationem, fugiat, nihil quasi ab tenetur eligendi eius porro consequatur nulla ad?</p>*
                <p><strong>
                        <h5 class="text-center">Score obtenue : @if(!empty($selectScore)) {{$selectScore}} / {{$exercice->Questions->count()}} Points @else 0 points @endif</h5>
                    </strong></p>
            </div>
            @else
            <div class="pd-20 card-box mb-30">
                <h2 class="mt-3 text-primary">Questions</h2>
                <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, quas facilis praesentium nostrum beatae ad voluptatem officiis obcaecati esse nesciunt aspernatur reiciendis dolorum unde distinctio soluta totam perspiciatis? Libero, aperiam!</p>
                <hr class="m-5">
                <form action="{{route('Quiz.Form')}}" id="QuizForm">
                    @csrf
                    <input type="hidden" name="idExercice" id="idExercice" value="{{$exercice->id}}">
                    @foreach($exercice->Questions as $question)
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <h5 class="mb-3"><label for="">{{$question->Question}}</label></h5>
                            <div class="form-group">
                                @foreach($question->Choixes as $key => $Choix)
                                <div class="custom-control custom-radio mb-5">
                                    <input type="radio" id="customRadio{{$question->id}}{{$key}}" name="question_{{$question->id}}" class="custom-control-input"
                                        value="{{$Choix->id}}" />
                                    <label class="custom-control-label" for="customRadio{{$question->id}}{{$key}}">{{$Choix->content}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary" id="QuestionSubmit">
                        <div class="spinner-border text-light save-load-btn-ma d-none"
                            style="width: 1rem; height: 1rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <span class="save-bu-ma">Valider le Questionnaire</span>
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
    @endforeach

</div>

</div>

<!-- <a
    href="#"
    class="btn-block"
    data-toggle="modal"
    data-target="#success-modal"
    type="button"
    class="d-none"
    id="modal-success">
</a>
<div
    class="modal fade"
    id="success-modal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div
        class="modal-dialog modal-dialog-centered"
        role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Felicitation</h3>
                <div class="mb-30 text-center">
                    <img src="{{asset('assets/vendors/images/success.png')}}" />
                </div>
                Lorem ipsum dolor sit amet, consectetur adipisicing
                elit, sed do eiusmod
                <div id="scorePart"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{route('Participant.Cours')}}" id="endBtn">Terminer</a>
            </div>
        </div>
    </div>
</div> -->

<button type="button" id="modal-success" hidden data-toggle="modal" data-target="#success-modal"
    data-backdrop="static" class="d-none">
    Launch modal
</button>
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered max-width-400" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h3 class="mb-20">Felicitation</h3>
                <div class="mb-30 text-center">
                    <img src="{{asset('assets/vendors/images/success.png')}}" />
                </div>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                eiusmod
                <div id="scorePart"></div>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="{{route('Participant.Cours')}}" id="endBtn">Terminer</a>
            </div>
        </div>
    </div>
</div>

<!-- welcome modal start -->
<button type="button" class="btn mb-20 btn-primary btn-block d-none" id="sa-success"></button>
<!-- welcome modal end -->

<!-- js -->
<script src="{{asset('assets/module/timer.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>

<script src="{{asset('assets/module/main.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
<script src="{{asset('assets/src/plugins/cropperjs/dist/cropper.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/advanced-components.js')}}"></script>

<script src="{{asset('assets/src/plugins/sweetalert2/sweetalert2.all.j')}}s"></script>
<script src="{{asset('assets/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script>

<script src="{{asset('assets/src/plugins/switchery/switchery.min.js')}}"></script>
<!-- bootstrap-tagsinput js -->
<script src="{{asset('assets/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>
<!-- bootstrap-touchspin js -->
<script src="{{asset('assets/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js')}}"></script>




<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
        style="display: none; visibility: hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</body>


</html>