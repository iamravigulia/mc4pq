<?php

namespace edgewizz\mc4pq\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Edgewizz\Edgecontent\Models\ProblemSetQues;
use Edgewizz\Mc4pq\Models\Mc4pqAns;
use Edgewizz\Mc4pq\Models\Mc4pqQues;
use Illuminate\Http\Request;

class Mc4pqController extends Controller
{
    // public function test()
    // {
    //     dd('hello');
    // }
    public function store(Request $request)
    {
        // dd($request->all());
        $pmQ = new Mc4pqQues();
        $pmQ->question              = $request->question;
        $pmQ->format_title          = $request->format_title;
        $pmQ->difficulty_level_id   = $request->difficulty_level_id;
        /* image1 */
        $q_media_1 = new Media();
        $request->q_media_1->storeAs('public/answers', time() . $request->q_media_1->getClientOriginalName());
        $q_media_1->url = 'answers/' . time() . $request->q_media_1->getClientOriginalName();
        $q_media_1->save();
        $pmQ->media1_id = $q_media_1->id;
        /* image1 */
        /* image1 */
        $q_media_2 = new Media();
        $request->q_media_2->storeAs('public/answers', time() . $request->q_media_2->getClientOriginalName());
        $q_media_2->url = 'answers/' . time() . $request->q_media_2->getClientOriginalName();
        $q_media_2->save();
        $pmQ->media2_id = $q_media_2->id;

        if($request->q_media_3){
            $q_media_3 = new Media();
            $request->q_media_3->storeAs('public/answers', time() . $request->q_media_3->getClientOriginalName());
            $q_media_3->url = 'answers/' . time() . $request->q_media_3->getClientOriginalName();
            $q_media_3->save();
            $pmQ->media3_id = $q_media_3->id;
        }

        if($request->q_media_4){
            $q_media_4 = new Media();
            $request->q_media_4->storeAs('public/answers', time() . $request->q_media_4->getClientOriginalName());
            $q_media_4->url = 'answers/' . time() . $request->q_media_4->getClientOriginalName();
            $q_media_4->save();
            $pmQ->media4_id = $q_media_4->id;
        }
        $pmQ->media_title1 = $request->media_title1;
        $pmQ->media_title2 = $request->media_title2;
        $pmQ->media_title3 = $request->media_title3;
        $pmQ->media_title4 = $request->media_title4;
        /* image1 */
        $pmQ->hint = $request->hint;
        $pmQ->save();
        /* answer1 */
        if ($request->answer_1) {
            $answer_1 = new Mc4pqAns();
            $answer_1->question_id = $pmQ->id;
            $answer_1->answer = $request->answer_1;
            if ($request->ans_correct_1) {
                $answer_1->arrange = 1;
            }
            $answer_1->eng_word = $request->eng_word1;
            $answer_1->save();
        }
        /* //answer1 */
        /* answer2 */
        if ($request->answer_2) {
            $answer_2 = new Mc4pqAns();
            $answer_2->question_id = $pmQ->id;
            $answer_2->answer = $request->answer_2;
            if ($request->ans_correct_2) {
                $answer_2->arrange = 1;
            }
            $answer_2->eng_word = $request->eng_word2;
            $answer_2->save();
        }
        /* //answer2 */
        /* answer3 */
        if ($request->answer_3) {
            $answer_3 = new Mc4pqAns();
            $answer_3->question_id = $pmQ->id;
            $answer_3->answer = $request->answer_3;
            if ($request->ans_correct_3) {
                $answer_3->arrange = 1;
            }
            $answer_3->eng_word = $request->eng_word3;
            $answer_3->save();
        }
        /* //answer3 */
        /* answer4 */
        if ($request->answer_4) {
            $answer_4 = new Mc4pqAns();
            $answer_4->question_id = $pmQ->id;
            $answer_4->answer = $request->answer_4;
            if ($request->ans_correct_4) {
                $answer_4->arrange = 1;
            }
            $answer_4->eng_word = $request->eng_word4;
            $answer_4->save();
        }
        /* //answer4 */
        if($request->problem_set_id && $request->format_type_id){
            $pbq = new ProblemSetQues();
            $pbq->problem_set_id = $request->problem_set_id;
            $pbq->question_id = $pmQ->id;
            $pbq->format_type_id = $request->format_type_id;
            $pbq->save();
        }
        return back();
    }
    public function edit($id, Request $request)
    {

    }

    public function imagecsv($question_image, $images){
        foreach($images as $valueImage){
            $uploadImage = explode(".", $valueImage->getClientOriginalName());
            if($uploadImage[0] == $question_image){
                // dd($valueImage);
                $media = new Media();
                $name = time() . uniqid() . $valueImage->getClientOriginalName();
                $valueImage->storeAs('public/question_images', $name);
                $media->url = 'question_images/' . $name;
                $media->save();
                return $media->id;
            }
        }
    }
    public function csv_upload(Request $request)
    {

        $file = $request->file('file');
        $images = $request->file('images');
        // dd($file);
        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
        // Valid File Extensions
        $valid_extension = array("csv");
        // 2MB in Bytes
        $maxFileSize = 2097152;
        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {
            // Check file size
            if ($fileSize <= $maxFileSize) {
                // File upload location
                $location = 'uploads/mc4pq';
                // Upload file
                $file->move($location, $filename);
                // Import CSV to Database
                $filepath = public_path($location . "/" . $filename);
                // Reading file
                $file = fopen($filepath, "r");
                $importData_arr = array();
                $i = 0;
                while (($filedata = fgetcsv($file, 1000, ",")) !== false) {
                    $num = count($filedata);
                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    for ($c = 0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    $i++;
                }
                fclose($file);
                // Insert to MySQL database
                foreach ($importData_arr as $importData) {
                    $insertData = array(
                        "question"      => $importData[1],
                        "answer1"       => $importData[2],
                        "arrange1"      => $importData[3],
                        "eng_word1"     => $importData[4],
                        "answer2"       => $importData[5],
                        "arrange2"      => $importData[6],
                        "eng_word2"     => $importData[7],
                        "answer3"       => $importData[8],
                        "arrange3"      => $importData[9],
                        "eng_word3"     => $importData[10],
                        "answer4"       => $importData[11],
                        "arrange4"      => $importData[12],
                        "eng_word4"     => $importData[13],
                        "media1"        => $importData[14],
                        "media2"        => $importData[15],
                        "level"         => $importData[16],
                        "hint"          => $importData[17],
                        "media3"        => $importData[18],
                        "media4"        => $importData[19],
                        "media_title1"  => $importData[20],
                        "media_title2"  => $importData[21],
                        "media_title3"  => $importData[22],
                        "media_title4"  => $importData[23],
                    );
                    // var_dump($insertData['answer1']);
                    /*  */
                    if ($insertData['question']) {
                        $fill_Q = new Mc4pqQues();
                        $fill_Q->question = $insertData['question'];
                        if($request->format_title){
                            $fill_Q->format_title = $request->format_title;
                        }
                        if(!empty($insertData['level'])){
                            if($insertData['level'] == 'easy'){
                                $fill_Q->difficulty_level_id = 1;
                            }else if($insertData['level'] == 'medium'){
                                $fill_Q->difficulty_level_id = 2;
                            }else if($insertData['level'] == 'hard'){
                                $fill_Q->difficulty_level_id = 3;
                            }
                        }
                        if (!empty($insertData['media1']) && $insertData['media1'] != '') {
                            $media1_id = $this->imagecsv($insertData['media1'], $images);
                            $fill_Q->media1_id = $media1_id;
                        }
                        if (!empty($insertData['media_title1']) && $insertData['media_title1'] != '') {
                            $fill_Q->media_title1 = $insertData['media_title1'];
                        }
                        if (!empty($insertData['media2']) && $insertData['media2'] != '') {
                            $media2_id = $this->imagecsv($insertData['media2'], $images);
                            $fill_Q->media2_id = $media2_id;
                        }
                        if (!empty($insertData['media_title2']) && $insertData['media_title2'] != '') {
                            $fill_Q->media_title2 = $insertData['media_title2'];
                        }
                        if (!empty($insertData['media3']) && $insertData['media3'] != '') {
                            $media3_id = $this->imagecsv($insertData['media3'], $images);
                            $fill_Q->media3_id = $media3_id;
                        }
                        if (!empty($insertData['media_title3']) && $insertData['media_title3'] != '') {
                            $fill_Q->media_title3 = $insertData['media_title3'];
                        }
                        if (!empty($insertData['media4']) && $insertData['media4'] != '') {
                            $media4_id = $this->imagecsv($insertData['media4'], $images);
                            $fill_Q->media4_id = $media4_id;
                        }
                        if (!empty($insertData['media_title4']) && $insertData['media_title4'] != '') {
                            $fill_Q->media_title4 = $insertData['media_title4'];
                        }
                        if ($insertData['hint'] == '-') {
                        }else{
                            $fill_Q->hint = $insertData['hint'];
                        }
                        $fill_Q->save();
                        if($request->problem_set_id && $request->format_type_id){
                            $pbq = new ProblemSetQues();
                            $pbq->problem_set_id = $request->problem_set_id;
                            $pbq->question_id = $fill_Q->id;
                            $pbq->format_type_id = $request->format_type_id;
                            $pbq->save();
                        }

                        if ($insertData['answer1'] == '-') {
                        } else {
                            $f_Ans1 = new Mc4pqAns();
                            $f_Ans1->question_id = $fill_Q->id;
                            $f_Ans1->answer = $insertData['answer1'];
                            $f_Ans1->arrange = $insertData['arrange1'];
                            if ($insertData['eng_word1'] == '-') {
                            } else {
                                $f_Ans1->eng_word = $insertData['eng_word1'];
                            }
                            $f_Ans1->save();
                        }
                        if ($insertData['answer2'] == '-') {
                        } else {
                            $f_Ans2 = new Mc4pqAns();
                            $f_Ans2->question_id = $fill_Q->id;
                            $f_Ans2->answer = $insertData['answer2'];
                            $f_Ans2->arrange = $insertData['arrange2'];
                            if ($insertData['eng_word2'] == '-') {
                            } else {
                                $f_Ans2->eng_word = $insertData['eng_word2'];
                            }
                            $f_Ans2->save();
                        }
                        if ($insertData['answer3'] == '-') {
                        } else {
                            $f_Ans3 = new Mc4pqAns();
                            $f_Ans3->question_id = $fill_Q->id;
                            $f_Ans3->answer = $insertData['answer3'];
                            $f_Ans3->arrange = $insertData['arrange3'];
                            if ($insertData['eng_word3'] == '-') {
                            } else {
                                $f_Ans3->eng_word = $insertData['eng_word3'];
                            }
                            $f_Ans3->save();
                        }
                        if ($insertData['answer4'] == '-') {
                        } else {
                            $f_Ans4 = new Mc4pqAns();
                            $f_Ans4->question_id = $fill_Q->id;
                            $f_Ans4->answer = $insertData['answer4'];
                            $f_Ans4->arrange = $insertData['arrange4'];
                            if ($insertData['eng_word4'] == '-') {
                            } else {
                                $f_Ans4->eng_word = $insertData['eng_word4'];
                            }
                            $f_Ans4->save();
                        }
                    }
                    /*  */
                }
                // Session::flash('message', 'Import Successful.');
            } else {
                // Session::flash('message', 'File too large. File must be less than 2MB.');
            }
        } else {
            // Session::flash('message', 'Invalid File Extension.');
        }
        return back();
    }

    public function update($id, Request $request){
        $q = Mc4pqQues::where('id', $id)->first();
        if($request->format_title){
            $q->format_title = $request->format_title;
        }
        $q->question = $request->question;
        $q->difficulty_level_id = $request->difficulty_level_id;
        // $q->level_id = $request->question_level;
        // $q->score = $request->question_score;
        $q->hint = $request->hint;
        if($request->question_media){
            $q_media = new Media();
            $request->question_media->storeAs('public/answers', time() . $request->question_media->getClientOriginalName());
            $q_media->url = 'answers/' . time() . $request->question_media->getClientOriginalName();
            $q_media->save();
            $q->media_id = $q_media->id;
        }
        $q->save();
        $answers = Mc4pqAns::where('question_id', $q->id)->get();
        foreach($answers as $ans){
            if($request->ans.$ans->id){
                $inputAnswer = 'answer'.$ans->id;
                $inputArrange = 'ans_correct'.$ans->id;
                $inputEngWord = 'eng_word'.$ans->id;
                $ans->answer = $request->$inputAnswer;
                $ans->eng_word = $request->$inputEngWord;
                if($request->$inputArrange){
                    $ans->arrange = 1;
                }else{
                    $ans->arrange = 0;
                }
                $ans->save();
            }
        }
        return back();
    }

    public function delete($id){
        $f = Mc4pqQues::where('id', $id)->first();
        $f->delete();
        $ans = Mc4pqAns::where('question_id', $f->id)->pluck('id');
        if($ans){
            foreach($ans as $a){
                $f_ans = Mc4pqAns::where('id', $a)->first();
                $f_ans->delete();
            }
        }
        return back();
    }

}
