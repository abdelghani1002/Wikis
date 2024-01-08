<aside class="md:w-1/6 h-[88dvh] bg-green-500 -translate-x-[90px] md:-translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto dark:bg-gray-800">
        <ul class="h-full font-medium flex flex-col justify-between">
            <div class="space-y-2">
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

                <li>
                    <a href="<?= $_ENV['APP_URL'] . "/dashboard" ?>" class="statistics flex flex-row-reverse md:flex-row justify-between gap-2 md:gap-0 md:justify-normal items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path d="M1 1V17C1 17.5304 1.21071 18.0391 1.58579 18.4142C1.96086 18.7893 2.46957 19 3 19H19" stroke="#ABB2BF" stroke-width="2" stroke-miterlimit="5.759" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M5 12L9 8L13 12L19 6" stroke="#ABB2BF" stroke-width="2" stroke-miterlimit="5.759" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 6H19V9" stroke="#ABB2BF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                        <span class="flex-1 m-0 md:ms-3 whitespace-nowrap">Statistics</span>
                    </a>
                </li>

                <li>
                    <a href="<?= $_ENV['APP_URL'] . "/dashboard/categories" ?>" class="categories flex flex-row-reverse md:flex-row justify-between md:justify-normal items-center p-2 text--900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M10.5 2.5C10.5 3.16304 10.2366 3.79893 9.76777 4.26777C9.29893 4.73661 8.66304 5 8 5C7.33696 5 6.70107 4.73661 6.23223 4.26777C5.76339 3.79893 5.5 3.16304 5.5 2.5C5.5 1.83696 5.76339 1.20107 6.23223 0.732233C6.70107 0.263392 7.33696 0 8 0C8.66304 0 9.29893 0.263392 9.76777 0.732233C10.2366 1.20107 10.5 1.83696 10.5 2.5ZM15.5 3C15.5 3.53043 15.2893 4.03914 14.9142 4.41421C14.5391 4.78929 14.0304 5 13.5 5C12.9696 5 12.4609 4.78929 12.0858 4.41421C11.7107 4.03914 11.5 3.53043 11.5 3C11.5 2.46957 11.7107 1.96086 12.0858 1.58579C12.4609 1.21071 12.9696 1 13.5 1C14.0304 1 14.5391 1.21071 14.9142 1.58579C15.2893 1.96086 15.5 2.46957 15.5 3ZM2.5 5C3.03043 5 3.53914 4.78929 3.91421 4.41421C4.28929 4.03914 4.5 3.53043 4.5 3C4.5 2.46957 4.28929 1.96086 3.91421 1.58579C3.53914 1.21071 3.03043 1 2.5 1C1.96957 1 1.46086 1.21071 1.08579 1.58579C0.710714 1.96086 0.5 2.46957 0.5 3C0.5 3.53043 0.710714 4.03914 1.08579 4.41421C1.46086 4.78929 1.96957 5 2.5 5ZM4 7.25C4 6.56 4.56 6 5.25 6H10.75C11.44 6 12 6.56 12 7.25V12C12 13.0609 11.5786 14.0783 10.8284 14.8284C10.0783 15.5786 9.06087 16 8 16C6.93913 16 5.92172 15.5786 5.17157 14.8284C4.42143 14.0783 4 13.0609 4 12V7.25ZM3 7.25C3 6.787 3.14 6.358 3.379 6H1.25C0.56 6 1.78381e-08 6.56 1.78381e-08 7.25V11C-4.66659e-05 11.4281 0.0915386 11.8513 0.268602 12.2411C0.445665 12.6309 0.704104 12.9782 1.02655 13.2599C1.34901 13.5415 1.728 13.7508 2.13807 13.8738C2.54813 13.9968 2.97978 14.0307 3.404 13.973C3.13645 13.3497 2.99898 12.6783 3 12V7.25ZM13 12C13 12.7 12.856 13.368 12.596 13.973C13.0202 14.0307 13.4519 13.9968 13.8619 13.8738C14.272 13.7508 14.651 13.5415 14.9734 13.2599C15.2959 12.9782 15.5543 12.6309 15.7314 12.2411C15.9085 11.8513 16 11.4281 16 11V7.25C16 6.56 15.44 6 14.75 6H12.621C12.861 6.358 13 6.787 13 7.25V12Z" />
                        </svg>

                        <span class="flex-1 m-0 md:ms-3 whitespace-nowrap">Categories</span>
                    </a>
                </li>

                <li>
                    <a href="<?= $_ENV['APP_URL'] . "/dashboard/tags" ?>" class="tags flex flex-row-reverse md:flex-row justify-between md:justify-normal items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 m-0 md:ms-3 whitespace-nowrap">Tags</span>
                    </a>
                </li>

                <li>
                    <a href="<?= $_ENV['APP_URL'] . "/dashboard/wikis" ?>" class="wikis flex flex-row-reverse md:flex-row justify-between md:justify-normal items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
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