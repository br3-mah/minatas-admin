<div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" id="memberid-input" class="form-control" value="">
                            <div class="px-1 pt-1">
                                <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                                    <img src="public/assets/images/small/img-9.jpg" alt="" id="cover-img" class="img-fluid">

                                    <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                                        <div class="flex-grow-1">
                                            <h5 class="modal-title text-white" id="createMemberLabel">Export Loan Sheet</h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="d-flex gap-3 align-items-center">
                                                <button type="button" class="btn-close btn-close-white"  id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mb-4 mt-n5 pt-2">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute bottom-0 end-0">
                                        <input class="form-control d-none" value="" id="member-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('export-loans') }}" method="POST"  class="flex flex-col gap-y-4 rounded-sm mb-2 bg-white p-3  dark:bg-boxdark sm:flex-row sm:items-center sm:justify-between">
                                @csrf
                                <div class="flex row">
                                    <span class="col-xl-6">
                                        <label class="mb-3 block text-xs font-medium text-black dark:text-white">
                                            From
                                        </label>
                                        <input name="from_date" type="date" class="custom-input-date form-control custom-input-date-1 w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                    </span>
                                    <span class="col-xl-6">
                                        <label class="mb-3 block text-xs font-medium text-black dark:text-white">
                                            To 
                                        </label>
                                        <input name="to_date" type="date" class="custom-input-date form-control custom-input-date-1 w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 font-medium outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                    </span>
                                </div>
                            
                                <div class="">
                                    <div class="pt-6">
                                        <button type="submit" class="mt-1 flex items-center gap-2 rounded bg-primary py-4 px-4.5 font-medium text-white hover:bg-opacity-80">
                                            Export Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div>