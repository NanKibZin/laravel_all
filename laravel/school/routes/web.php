<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignClassTeacherController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\FeeHeadController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\ParentContoller;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\AssignClassTeacher;
use Illuminate\Support\Facades\Route;


Route::get("/login",[AdminController::class,'index'])->name('admin.login');
Route::post("/auth",[AdminController::class,'auth'])->name('admin.auth');
Route::get("/register",[AdminController::class,'register'])->name('admin.register');
Route::get("/logout",[AdminController::class,'logout'])->name('admin.logout');
Route::get("/forgot-password",[AdminController::class,'forgotPassword'])->name('forgot-password');
Route::post("/post-password",[AdminController::class,'postPassword'])->name('post-password');

Route::group(['middleware'=>'admin'],function(){
    Route::get("admin/dashboard",[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get("admin/list",[AdminController::class,'list'])->name('admin.list');
    Route::get("admin/add",[AdminController::class,'add'])->name('admin.add');
    Route::post("admin/insert",[AdminController::class,'register'])->name('admin.insert');
    Route::get("admin/edit/{id}",[AdminController::class,'edit'])->name('admin.edit');
    Route::get("admin/delete/{id}",[AdminController::class,'delete'])->name('admin.delete');
    Route::post("admin/update",[AdminController::class,'register'])->name('admin.update');
    Route::get("admin/changPass",[UserController::class,'index']);
    Route::post("admin/changPass",[UserController::class,'changePassword']);
    
      //student
      Route::get("/stu/create",[StudentController::class,'index'])->name('stu.create');
      Route::post("/stu/store",[StudentController::class,'store'])->name('stu.store');
      Route::get("/stu/read",[StudentController::class,'read'])->name('stu.read');
      Route::get("/stu/delete/{id}",[StudentController::class,'delete'])->name('stu.delete');
      Route::get("/stu/edit/{id}",[StudentController::class,'edit'])->name('stu.edit');
      Route::post("/stu/update",[StudentController::class,'update'])->name('stu.update');
  

     //Classes 
     Route::get("/class/create",[ClassesController::class,'index'])->name('class.create');
     Route::post("/class/store",[ClassesController::class,'store'])->name('class.store');
     Route::get("/class/read",[ClassesController::class,'read'])->name('class.read');
     Route::get("/class/delete/{id}",[ClassesController::class,'delete'])->name('class.delete');
     Route::get("/class/edit/{id}",[ClassesController::class,'edit'])->name('class.edit');
     Route::post("/class/update",[ClassesController::class,'update'])->name('class.update');

      //Subject
    Route::get("/sub/index",[SubjectController::class,'index'])->name('sub.index');
    Route::post("/sub/add",[SubjectController::class,'add'])->name('sub.add');
    Route::get("/sub/list",[SubjectController::class,'list'])->name('sub.list');
    Route::get("/sub/delete/{id}",[SubjectController::class,'delete'])->name('sub.delete');
    Route::get("/sub/edit/{id}",[SubjectController::class,'edit'])->name('sub.edit');
    Route::post("/sub/update",[SubjectController::class,'update'])->name('sub.update');

    //Class Subject
    Route::get("/cs/index",[ClassSubjectController::class,'index'])->name('cs.index');
    Route::post("/cs/add",[ClassSubjectController::class,'add'])->name('cs.add');
    Route::get("/cs/list",[ClassSubjectController::class,'list'])->name('cs.list');
    Route::get("/cs/delete/{id}",[ClassSubjectController::class,'delete'])->name('cs.delete');
    Route::get("/cs/edit/{id}",[ClassSubjectController::class,'edit'])->name('cs.edit');
    Route::post("/cs/update",[ClassSubjectController::class,'update'])->name('cs.update');

   
     //parent
     Route::get("/pa/create",[ParentContoller::class,'index'])->name('pa.create');
     Route::post("/pa/store",[ParentContoller::class,'store'])->name('pa.store');
     Route::get("/pa/read",[ParentContoller::class,'read'])->name('pa.read');
     Route::get("/pa/delete/{id}",[ParentContoller::class,'delete'])->name('pa.delete');
     Route::get("/pa/edit/{id}",[ParentContoller::class,'edit'])->name('pa.edit');
     Route::post("/pa/update",[ParentContoller::class,'update'])->name('pa.update');
     Route::get("/pa/mySon/{id}",[ParentContoller::class,'mySon'])->name('pa.mySon');
     Route::post("/pa/mySon/{student_id}/{parent_id}",[ParentContoller::class,'assignStudentToParent'])->name('pa.mySonPa');
 
   
     //teacher
     Route::get("/te/create",[TeacherController::class,'index'])->name('te.create');
     Route::post("/te/store",[TeacherController::class,'store'])->name('te.store');
     Route::get("/te/read",[TeacherController::class,'read'])->name('te.read');
     Route::get("/te/delete/{id}",[TeacherController::class,'delete'])->name('te.delete');
     Route::get("/te/edit/{id}",[TeacherController::class,'edit'])->name('te.edit');
     Route::post("/te/update",[TeacherController::class,'update'])->name('te.update');
 

     // Assign class to teacher
     Route::get("/ct/index",[AssignClassTeacherController::class,'index'])->name('ct.index');
     Route::post("/ct/add",[AssignClassTeacherController::class,'add'])->name('ct.add');
     Route::get("/ct/list",[AssignClassTeacherController::class,'list'])->name('ct.list');
     Route::get("/ct/delete/{id}",[AssignClassTeacherController::class,'delete'])->name('ct.delete');
     Route::get("/ct/edit/{id}",[AssignClassTeacherController::class,'edit'])->name('ct.edit');
     Route::post("/ct/update",[AssignClassTeacherController::class,'update'])->name('ct.update');
 

    Route::get("/form",[AdminController::class,'form'])->name('admin.form');
    Route::get("/table",[AdminController::class,'table'])->name('admin.table');
    //Academic year
    Route::get("/academic-year/create",[AcademicYearController::class,'index'])->name('academic-year.create');
    Route::post("/academic-year/store",[AcademicYearController::class,'store'])->name('academic-year.store');
    Route::get("/academic-year/read",[AcademicYearController::class,'read'])->name('academic-year.read');
    Route::get("/academic-year/delete/{id}",[AcademicYearController::class,'delete'])->name('academic-year.delete');
    Route::get("/academic-year/edit/{id}",[AcademicYearController::class,'edit'])->name('academic-year.edit');
    Route::post("/academic-year/update",[AcademicYearController::class,'update'])->name('academic-year.update');
   
    //fee Head
    Route::get("/fee-head/create",[FeeHeadController::class,'index'])->name('fee-head.create');
    Route::post("/fee-head/store",[FeeHeadController::class,'store'])->name('fee-head.store');
    Route::get("/fee-head/read",[FeeHeadController::class,'read'])->name('fee-head.read');
    Route::get("/fee-head/delete/{id}",[FeeHeadController::class,'delete'])->name('fee-head.delete');
    Route::get("/fee-head/edit/{id}",[FeeHeadController::class,'edit'])->name('fee-head.edit');
    Route::post("/fee-head/update",[FeeHeadController::class,'update'])->name('fee-head.update');

    //fee Sturcture
    Route::get("/fee-str/create",[FeeStructureController::class,'index'])->name('fee-str.create');
    Route::post("/fee-str/store",[FeeStructureController::class,'store'])->name('fee-str.store');
    Route::get("/fee-str/read",[FeeStructureController::class,'read'])->name('fee-str.read');
    Route::get("/fee-str/delete/{id}",[FeeStructureController::class,'delete'])->name('fee-str.delete');
    Route::get("/fee-str/edit/{id}",[FeeStructureController::class,'edit'])->name('fee-str.edit');
    Route::post("/fee-str/update",[FeeStructureController::class,'update'])->name('fee-str.update');

   
});
Route::group(['middleware'=>'student'],function(){
    Route::get("student/dashboard",[DashbordController::class,'dashboard'])->name('student.dashboard');
    Route::get("student/changPass",[UserController::class,'index']);
    Route::post("student/changPass",[UserController::class,'changePassword']);

    Route::get("student/profile",[UserController::class,'profile']);
    Route::post("student/profile",[UserController::class,'changeProfile']);
    //student Subject
    Route::get("stu/my-subject",[StudentController::class,'my_subject'])->name('stu.my-subject');
    
});
Route::group(['middleware'=>'teacher'],function(){
    Route::get("teacher/dashboard",[DashbordController::class,'dashboard'])->name('teacher.dashboard');
    Route::get("teacher/changPass",[UserController::class,'index']);
    Route::post("teacher/changPass",[UserController::class,'changePassword']);

    Route::get("teacher/profile",[UserController::class,'profile']);
    Route::post("teacher/profile",[UserController::class,'changeProfile']);

    //my class subject
     Route::get("teacher/myClassSubject",[TeacherController::class,'myClassSubject'])->name('teacher.subject.class');
    
});
Route::group(['middleware'=>'parent'],function(){
    Route::get("parent/dashboard",[DashbordController::class,'dashboard'])->name('parent.dashboard');
    Route::get("parent/changPass",[UserController::class,'index']);
    Route::post("parent/changPass",[UserController::class,'changePassword']);
    
    Route::get("parent/profile",[UserController::class,'profile']);
    Route::post("parent/profile",[UserController::class,'changeProfile']);

    //parent My student
    Route::get("parent/myStu/{id}",[ParentContoller::class,'myStu'])->name('pa.myStu');
    
});






