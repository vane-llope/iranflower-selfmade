<x-layout>
  @if(str_contains($path,'roles'))
  <x-role-form :formInputs="$formInputs" :record="$record"  :action="$path"/>
  @else
    <x-form :formInputs="$formInputs" :record="$record"  :action="$path"/>
    @endif
    </x-layout>
    