<div class="_requestForm">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <!--start -->
    <div class="row pt-2 pb-2">
        <!--start cell-->
        <div class="cell-md-6">
            <div class="own-input-box">
                <div class="own-label">
                    <div class="label">
                       Vendor
                    </div>

                </div>
                <select data-role="select" class="own-select">
                    <option value="1" data-template="<span class='mif-amazon icon'></span> $1">Amazon</option>
                    <option value="2" data-template="<span class='mif-apple icon'></span> $1">Apple</option>
                    <option value="3" data-template="<span class='mif-blogger icon'></span> $1">Blogger</option>
                    <option value="4" data-template="<span class='mif-evernote icon'></span> $1">Evernote</option>
                    <option value="5" data-template="<span class='mif-github icon'></span> $1">GitHub</option>
                </select>
                <div class="own-info-box">
                    amamr sonar bankss
                </div>
            </div>
        </div>
        <!--end cell-->
        <!--start cell-->
        <div class="cell-md-6">
            <div class="own-input-box">
                <div class="own-label">
                    <div class="label">
                       Type
                    </div>

                </div>
                <select data-role="select" class="own-select">
                    <option value="1" data-template="<span class='mif-amazon icon'></span> $1">Amazon</option>
                    <option value="2" data-template="<span class='mif-apple icon'></span> $1">Apple</option>
                    <option value="3" data-template="<span class='mif-blogger icon'></span> $1">Blogger</option>
                    <option value="4" data-template="<span class='mif-evernote icon'></span> $1">Evernote</option>
                    <option value="5" data-template="<span class='mif-github icon'></span> $1">GitHub</option>
                </select>
                <div class="own-info-box">
                    amamr sonar bankss
                </div>
            </div>
        </div>
        <!--end cell-->
        <!--start cell-->
        <div class="cell-md-6">
            <div class="own-input-box">
                <div class="own-label">
                    <div class="label">
                        Request Number
                    </div>
                    <div class="own-button-group">
                        <button class="button mini">
                            <span class="icon mif-zoom-in"></span>
                        </button>
                        <div class="own-counter">
                            <span class="txt">count</span>
                            <span class="val">0</span>
                        </div>
                    </div>
                </div>
                <input type="number" class="own-input">
                <div class="own-info-box">
                    amamr sonar bankss
                </div>
            </div>
        </div>
        <!--end cell-->
        <!--start cell-->
        <div class="cell-md-6">
            <div class="own-input-box">
                <div class="own-label">
                    <div class="label">
                        Request Number
                    </div>
                    <div class="own-button-group">
                        <button class="button mini">
                            <span class="icon mif-zoom-in"></span>
                        </button>
                        <div class="own-counter">
                            <span class="txt">count</span>
                            <span class="val">0</span>
                        </div>
                    </div>
                </div>
                <input type="number" class="own-input">
                <div class="own-info-box">
                    amamr sonar bankss
                </div>
            </div>
        </div>
        <!--end cell-->
        <!--start cell-->
        <div class="cell-md-6">
            <div class="own-input-box error">
                <div class="own-label">
                    <div class="label">
                        Request Number
                    </div>

                </div>
                <input type="text" class="own-input" wire:model.debounce.0ms="name">
                <div class="own-info-box">
                    My name is chica-chica {{ $name }}
                </div>
            </div>
        </div>
        <!--end cell-->
        <!--start cell-->
        <div class="cell-md-6">
            <div class="own-input-box">
                <div class="own-label">
                    <div class="label">
                        Name
                    </div>

                </div>
                <input type="number" class="own-input">
                <div class="own-info-box">
                    amamr sonar bankss
                </div>
            </div>
        </div>
        <!--end cell-->
        <!--start cell-->
        <div class="cell-md-6">
            <div class="own-input-box">
                <div class="own-label">
                    <div class="label">
                        Confirm Amount
                    </div>

                </div>
                <input type="number" class="own-input">
                <div class="own-info-box">
                    amamr sonar bankss
                </div>
            </div>
        </div>
        <!--end cell-->
        <!--start cell-->
        <div class="cell-md-6">
            <div class="own-input-box">
                <div class="own-label">
                    <div class="label">
                        Phone
                    </div>

                </div>
                <input type="number" class="own-input">
                <div class="own-info-box">

                </div>
            </div>
        </div>
        <!--end cell-->
        <!--start cell-->
        <div class="cell-md-12 text-center">
            <div class="own-submit-box">

                <button wire:click="confirm" class="button yellow">Confirm</button>

            </div>
        </div>
        <!--end cell-->

    </div>
       
</div>
