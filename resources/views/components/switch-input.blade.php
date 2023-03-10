<style>
.lbl::after{
    content: '';
    display: block;
    width: 25px;
    height: 25px;
    background: #eee;
    border-radius: 100px;
    position: absolute;
    top: 4px;
    left: 4px;
    transition: .2s;
}
</style>
@props([
    'disabled'  => false, 
    'name'      => 'default_check',
    'id'        => 'default_check',
    'color_off' => 'bg-neutral-500',
    'color_on'  => 'bg-green-600',
    'value'     => false,
    ])

    <input {{ $disabled ? 'disabled' : '' }} id="{{$id}}" name="{{$name}}" class='hidden peer' type="checkbox" @if ($value)
        checked
    @endif />
    <label {{$attributes->merge(["class"=>"lbl w-[65px] h-[33px] cursor-pointer relative rounded-[100px] duration-200 ".$color_off." peer-checked:bg-green-600 peer-checked:after:left-[36px]"])}} for="{{$id}}"></label>
