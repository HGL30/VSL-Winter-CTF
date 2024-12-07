@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/Ruler.css">
<main role="main">
    <div class="jumbotron">
        <div class="container">
            <span>Rules</span>
        </div>
    </div>
    <div class="card-container">
        <div class="card">
            <h3>Times</h3>
            <div class="time-section">
                <p>Preliminary round</p>
                <ul class="bullet-list">
                    <li>Start: <b>8:00</b> - <b>21/12/2024</b></li><br>
                    <li>End: <b>16:00</b> - <b>21/12/2024</b></li>
                </ul>
            </div>
            <div class="time-section">
                <p>Final round</p>
                <ul class="bullet-list ">
                    <li>From <b>7:00</b> to <b>12:00</b> - <b>28/12/2024</b>. At <b>Vietnam-Korea University of Information and Communication Technology</b></li>
                </ul>
            </div>
        </div>

            <div class="card">
            <h3>Participants</h3>
            <div class="time-section1">
                <p>Scope: University of Danang</p>
                <p>Contestants: Students majoring in Cyber Security (required) and other majors</p>
            <ul class="bullet-list">
              <li>Note:</li>
              <ul class="bullet-list2">
                <li>Students who have won the First Prize of the “Digital Dragon the Cyber ​​Security Challenges” competition and participated in the Final round of the “ASEAN Students with Information Security” competition are NOT eligible to participate in the competition.</li>
                <li>Students from other majors are encouraged to apply.</li>
              </ul>
            </ul>   
            </div>
            </div>

            <div class="card">
              <h3>Preliminary and final rounds</h3>
              <div class="time-section">
                <p>Exam format:</p>
                <ul class="bullet-list">
                  <li>Preliminary round: Online - Jeopardy.</li>
                  <li>Final round: Offline at VKU Danang campus - Attack-Defense.</li>
                </ul>
              </div>
              <div class="time-section">
                <p>Challenge content includes: Web Exploitation, Cryptography, Reverse Engineering, Forensics, PWN, OSINT</p>
                <p>Flag Format: VSL{flag}</p>
              </div>
            </div>
            <div class="card">
              <h3>Dynamic Scoring System</h3>
            <div class="time-section1">
              <p>Points will be reduced based on the number of times a question is solved to prevent sharing of answers between candidates and increase competition. The maximum score for each question is 1000 points, with each candidate completing the question reducing the score to a minimum of 100 points. Candidates using Hints will have their points deducted.</p>
            </div>
        </div>
          <div class="card">
          <h3>Competition Rules</h3>
          <div class="time-section">
            <ul class="bullet-list">
              <li>Teams are NOT allowed to share their methods or results (Flags) with others. The Organizing Committee will re-check the results if there is any doubt.</li>
              <li>Teams are NOT allowed to launch denial of service (DDoS) attacks on the network. If the Organizing Committee detects this action, the team's account will be immediately blocked and the results will be canceled.</li>
              <li>If the Team finds an error or vulnerability in the scoreboard (such as not updating results, updating incorrectly...), please notify the Organizing Committee, the Organizing Committee can consider adding more points to the Team.</li>
              <li>If the Team thinks they have done the right thing, have submitted the correct results but the scoreboard does not accept those results, please notify the Organizing Committee on the Discord of the competition.</li>
              <li>The Organizing Committee's decision is final.</li>
            </ul>
          </div>
          </div>
          <div class="card">
            <h3>Prizes</h3>
            <div class="time-section">
              <ul class="bullet-list">
                <li>The Preliminary Round does not consider awards, only the Final Round awards are considered.</li>
                <li>
                  Prize structure (expected):
                  <ul>
                    <li>First Prize: 2000$</li>
                    <li>Second Prize: 1000$</li>
                    <li>Third Prize: 500$</li>
                    <li>Consolation Prize: 200$</li>
                    <li>All teams participant will have Certificate</li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
            <div class="card">
            <h3>Contacts</h3>
            <div class="time-section">
              <p>- Website: <a href="https://vku.udn.vn" target="_blank" style="text-decoration: none; color: purple;">VKU</a></p>
              <p>- FanPage: <a href="https://vku.udn.vn" target="_blank" style="text-decoration: none; color: purple;">VKU</a></p>
              <p>- FanPage Faculty of Computer Engineering and Electronics: <a href="https://vku.udn.vn" target="_blank" style="text-decoration: none; color: purple;">Faculty of Computer Engineering and Electronics</a></p>
              <p>- Discord VSLCTF 2024: <a href="" target="_blank" style="text-decoration: none; color: purple;">Discord</a></p>
            </div>
            </div>
    </div>      
</main>
@endsection
