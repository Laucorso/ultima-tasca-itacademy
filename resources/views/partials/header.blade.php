<header class="bg-nav">
    <div class="flex justify-between">
        <div class="p-1 mx-3 inline-flex items-center">
            <i class="fas fa-bars pr-2 text-white" onclick="sidebarToggle()"></i>
            <img src ="https://th.bing.com/th/id/R.478bc151f6e603ae203e6b07341eec45?rik=%2frX6M54ZN6P3%2bQ&riu=http%3a%2f%2fcliparts.co%2fcliparts%2f8iG%2fEd9%2f8iGEd9n5T.png&ehk=hr%2bRJDcSba7lquumRTxLPH0%2f5iyUXcUT7FIlE1MbQsY%3d&risl=&pid=ImgRaw&r=0" class ="w-12">
        </div>
        <div class="p-1 flex flex-row items-center">

            <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="https://avatars0.githubusercontent.com/u/4323180?s=460&v=4" alt="">
            <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">{{ Auth::user()->name }}</a>
            <div id="ProfileDropDown" class="rounded hidden shadow-md bg-white absolute pin-t mt-20 w-auto">
                <ul class="list-reset">
                    <li>
                        <a href="#" class="p-1 font-semibold underline">Account</a>
                     </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class = "mx-auto p-1 underline font-semibold">Log out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>