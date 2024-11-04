<select id="{{ $id }}" class="{{ $class }}" {{ $attributes }}>
    {{ $slot }}
    @foreach ($options as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
