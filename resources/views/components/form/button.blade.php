<button {{ $attributes->except('title')->merge(['type' => 'submit', 'class' => 'btn']) }}>{{ $title }}</button>
