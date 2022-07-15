<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyThemeRequest;
use App\Http\Requests\StoreThemeRequest;
use App\Http\Requests\UpdateThemeRequest;
use App\Models\Theme;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ThemeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('theme_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $themes = Theme::all();

        return view('admin.themes.index', compact('themes'));
    }

    public function create()
    {
        abort_if(Gate::denies('theme_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.themes.create');
    }

    public function store(StoreThemeRequest $request)
    {
        $theme = Theme::create($request->all());

        return redirect()->route('admin.themes.index');
    }

    public function edit(Theme $theme)
    {
        abort_if(Gate::denies('theme_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.themes.edit', compact('theme'));
    }

    public function update(UpdateThemeRequest $request, Theme $theme)
    {
        $theme->update($request->all());

        return redirect()->route('admin.themes.index');
    }

    public function show(Theme $theme)
    {
        abort_if(Gate::denies('theme_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $theme->load('themeProjects');

        return view('admin.themes.show', compact('theme'));
    }

    public function destroy(Theme $theme)
    {
        abort_if(Gate::denies('theme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $theme->delete();

        return back();
    }

    public function massDestroy(MassDestroyThemeRequest $request)
    {
        Theme::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
