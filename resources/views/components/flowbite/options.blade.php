<details class="tweet-option relative text-gray-500">
    <summary>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
        </svg>
    </summary>
    <div class="absolute right-0 z-20 w-24 rounded bg-white pt-1 pb-1 shadow-md">
        <div>
            <a href="{{ route('manageapp.employee.select', ['staffCode' => $staffCode]) }}"
                class="flex items-center pt-1 pb-1 pl-3 pr-3 hover:bg-gray-100">
                <svg role="img" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24"
                    aria-labelledby="clipboardIconTitle" stroke="#2329D6" stroke-width="2" stroke-linecap="square"
                    stroke-linejoin="miter" fill="none" color="#2329D6">
                    <polyline points="15 3 19 3 19 21 5 21 5 3 5 3 9 3" />
                    <path
                        d="M14,4 L10,4 C9.44771525,4 9,3.55228475 9,3 C9,2.44771525 9.44771525,2 10,2 L14,2 C14.5522847,2 15,2.44771525 15,3 C15,3.55228475 14.5522847,4 14,4 Z" />
                </svg>
                <span>照会</span>
            </a>
        </div>
        <div>
            <a href="{{ route('manageapp.employee.edit', ['staffCode' => $staffCode]) }}"
                class="flex items-center pt-1 pb-1 pl-3 pr-3 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                    <path fill-rule="evenodd"
                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                        clip-rule="evenodd" />
                </svg>
                <span>編集</span>
            </a>
        </div>
        <div>
            {{-- <form action="{{ route('manageapp.delete') }}" method="post"
                onclick="return confirm('削除してもよろしいですか?');">
                @method('DELETE')
                @csrf
                <button type="submit" class="flex w-full items-center pt-1 pb-1 pl-3 pr-3 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>削除</span>
                </button>
            </form> --}}
            <span>削除</span>
        </div>
    </div>
</details>


@once
    @push('css')
        <style>
            .tweet-option>summary {
                list-style: none;
                cursor: pointer;
            }

            .tweet-option[open]>summary::before {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 10;
                display: block;
                content: " ";
                background: transparent;
            }
        </style>
    @endpush
@endonce
