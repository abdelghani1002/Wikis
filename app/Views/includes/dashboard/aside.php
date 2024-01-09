<aside class="md:w-1/6 h-[88dvh] bg-emerald-400 -translate-x-[90px] md:-translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto dark:bg-gray-800">
        <ul class="h-full font-medium flex flex-col justify-between">
            <div class="space-y-2">
                <!-- Home -->
                <li>
                    <a href="<?= $_ENV['APP_URL'] ?>" class="home flex flex-row-reverse md:flex-row justify-between md:justify-normal items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <div class="">
                            <svg class="-ml-1 -mr-1 flex-shrink-0 w-7 h-7 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="100" height="100" viewBox="0,0,256,256">
                                <g fill="#708090" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                    <g transform="scale(3.55556,3.55556)">
                                        <path d="M36,10c-1.139,0 -2.27708,0.38661 -3.20508,1.16211l-21.27734,17.7793c-1.465,1.224 -1.96564,3.32881 -1.05664,5.00781c1.251,2.309 4.20051,2.79122 6.10352,1.19922l18.79492,-15.70313c0.371,-0.31 0.91025,-0.31 1.28125,0l18.79492,15.70313c0.748,0.626 1.6575,0.92969 2.5625,0.92969c1.173,0 2.33591,-0.51091 3.12891,-1.50391c1.377,-1.724 0.98597,-4.27055 -0.70703,-5.68555l-2.41992,-2.02148v-10.19922c0,-1.473 -1.19402,-2.66797 -2.66602,-2.66797h-2.66602c-1.473,0 -2.66797,1.19497 -2.66797,2.66797v3.51367l-10.79492,-9.01953c-0.928,-0.7755 -2.06608,-1.16211 -3.20508,-1.16211zM35.99609,22.92578l-22,18.37695v8.69727c0,4.418 3.582,8 8,8h28c4.418,0 8,-3.582 8,-8v-8.69727zM32,38h8c1.105,0 2,0.895 2,2v10h-12v-10c0,-1.105 0.895,-2 2,-2z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <div class="">
                            <span class="flex-1 m-0 md:ms-3 whitespace-nowrap">Home</span>
                        </div>
                    </a>
                </li>

                <!-- Statisctics -->
                <li>
                    <a href="<?= $_ENV['APP_URL'] . "/dashboard" ?>" class="statistics flex flex-row-reverse md:flex-row justify-between gap-2 md:gap-0 md:justify-normal items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path d="M1 1V17C1 17.5304 1.21071 18.0391 1.58579 18.4142C1.96086 18.7893 2.46957 19 3 19H19" stroke="#708090" stroke-width="2" stroke-miterlimit="5.759" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5 12L9 8L13 12L19 6" stroke="#708090" stroke-width="2" stroke-miterlimit="5.759" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 6H19V9" stroke="#708090" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span class="flex-1 m-0 md:ms-3 whitespace-nowrap">Statistics</span>
                    </a>
                </li>

                <!-- Categories -->
                <li>
                    <a href="<?= $_ENV['APP_URL'] . "/dashboard/categories" ?>" class="categories flex flex-row-reverse md:flex-row justify-between md:justify-normal items-center p-2 text--900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg width="19px" height="20px" viewBox="0 0 19 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Rounded" transform="translate(-614.000000, -3124.000000)">
                                    <g id="Maps" transform="translate(100.000000, 3068.000000)">
                                        <g id="-Round-/-Maps-/-category" transform="translate(511.000000, 54.000000)">
                                            <g>
                                                <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                                <path d="M11.15,3.4 C11.54,2.76 12.46,2.76 12.85,3.4 L16.56,9.48 C16.97,10.14 16.49,11 15.71,11 L8.28,11 C7.5,11 7.02,10.14 7.43,9.48 L11.15,3.4 Z M17.5,22 C15.0147186,22 13,19.9852814 13,17.5 C13,15.0147186 15.0147186,13 17.5,13 C19.9852814,13 22,15.0147186 22,17.5 C22,19.9852814 19.9852814,22 17.5,22 Z M4,21.5 C3.45,21.5 3,21.05 3,20.5 L3,14.5 C3,13.95 3.45,13.5 4,13.5 L10,13.5 C10.55,13.5 11,13.95 11,14.5 L11,20.5 C11,21.05 10.55,21.5 10,21.5 L4,21.5 Z" id="🔹-Icon-Color" fill="#708090"></path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>

                        <span class="flex-1 m-0 md:ms-3 whitespace-nowrap">Categories</span>
                    </a>
                </li>

                <!-- Tags -->
                <li>
                    <a href="<?= $_ENV['APP_URL'] . "/dashboard/tags" ?>" class="tags flex flex-row-reverse md:flex-row justify-between md:justify-normal items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" id="id_101" style="stroke: rgb(112, 128, 144);"></path>
                            <line x1="7" y1="7" x2="7" y2="7" id="id_102" style="stroke: rgb(112, 128, 144);"></line>
                        </svg>
                        <span class="flex-1 m-0 md:ms-3 whitespace-nowrap">Tags</span>
                    </a>
                </li>

                <!-- Wikis -->
                <li>
                    <a href="<?= $_ENV['APP_URL'] . "/dashboard/wikis" ?>" class="wikis flex flex-row-reverse md:flex-row justify-between md:justify-normal items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" xml:space="preserve" width="1.70666in" height="1.70666in" version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd" viewBox="0 0 1707 1707" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs>
                                <style type="text/css">
                                    .fil0 {
                                        fill: #000002
                                    }
                                </style>
                            </defs>
                            <g id="Layer_x0020_1">
                                <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                <path class="fil0" d="M1500 219l-576 0c-30,0 -30,-46 0,-46l576 0c29,0 29,46 0,46zm184 1488l-1661 0c-13,0 -23,-11 -23,-23l0 -1661c0,-13 10,-23 23,-23l1661 0c12,0 23,10 23,23l0 1661c0,12 -11,23 -23,23zm-1638 -46l1615 0 0 -1270 -1615 0 0 1270zm1615 -1315l0 -300 -1615 0 0 300 1615 0zm-108 1091l-1371 0c-30,0 -30,-45 0,-45l1371 0c30,0 30,45 0,45zm-214 138l-943 0c-30,0 -30,-46 0,-46l943 0c30,0 30,46 0,46zm-697 -275c-8,0 -16,-5 -20,-13l-388 -776c-13,-27 27,-47 41,-21l367 736 200 -399 -158 -316c-13,-27 27,-47 41,-21l142 286 143 -286c14,-26 54,-6 41,21l-158 316 199 399 368 -736c14,-26 54,-6 41,21l-388 776c-9,17 -33,17 -41,0l-205 -409 -204 409c-4,8 -12,13 -21,13zm-381 -1028c-42,0 -77,-34 -77,-76 0,-42 35,-77 77,-77 42,0 76,35 76,77 0,42 -34,76 -76,76zm0 -107c-41,0 -41,62 0,62 41,0 41,-62 0,-62zm217 107c-42,0 -76,-34 -76,-76 0,-42 34,-77 76,-77 42,0 77,35 77,77 0,42 -35,76 -77,76zm0 -107c-41,0 -41,62 0,62 41,0 41,-62 0,-62zm217 107c-42,0 -76,-34 -76,-76 0,-42 34,-77 76,-77 43,0 77,35 77,77 0,42 -34,76 -77,76zm0 -107c-40,0 -40,62 0,62 41,0 41,-62 0,-62z" id="id_101" style="fill: rgb(112, 128, 144);"></path>
                            </g>
                        </svg>
                        <span class="flex-1 m-0 md:ms-3 whitespace-nowrap">Wikis</span>
                    </a>
                </li>


            </div>

            <div>
                <li>
                    <a href="#" class="flex flex-row-reverse md:flex-row justify-between md:justify-normal items-center p-2 text-gray-900 rounded-lg dark:text-white bg-gray-300 dark:hover:bg-gray-700 group">
                        <svg class="rotate-180 flex-shrink-0 w-5 h-5 ml-2  text-gray-500 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                        </svg>
                        <span class="flex-1 m-0 md:ms-3 whitespace-nowrap">Sign Up</span>
                    </a>
                </li>
            </div>
        </ul>
    </div>
</aside>