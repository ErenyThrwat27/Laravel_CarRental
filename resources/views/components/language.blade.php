<form action="{{route('language.switch')}}" method="post">
    @csrf
    <select class="form-select" name="language" onchange="this.form.submit()">
        <option value="en" {{app()->getLocale()==='en'?'selected':''}}>English</option>
        <option value="ar" {{app()->getLocale()==='ar'?'selected':''}}>Arabic</option>
        <option value="fr" {{app()->getLocale()==='fr'?'selected':''}}>French</option>
    </select>
</form>