<div class="content d-flex flex-column flex-column-fluid justify-content-center align-items-center" id="kt_content">
    <div class="post d-flex flex-column-fluid justify-content-center align-items-center" id="kt_post">
        <div id="kt_content_container" class="container-xxl d-flex flex-column justify-content-center align-items-center">
            <div class="container text-center space-y-3">
                <h1 class="text-info">Loan Opened</h1>
                <img width="200" class="my-4" src="https://stmaryscollege.ac.in/MenuImages/bullet1.gif" alt="">
                <div style="width: 100%; margin: 0 auto;">
                    <a style="box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;" href="{{ route('detailed', $loan->id ) }}" class="btn btn-primary gap-2 d-flex justify-content-center align-items-center">
                        View Open Loan
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
