<!DOCTYPE html>
<html lang="en">

<body>
　  <th>Q1：入院の経験はありますか</th>
    <label><input type="radio" id="user0" name="user" onClick="userflg0(this.checked);"/> 個人</label> 
    <label><input type="radio" id="user1" name="user" onClick="userflg1(this.checked);"/> 部署</label>
    <br>
    <th>Q2: Q1で「はい」と答えた方に質問します。どのような病気で入院されましたか？</th>
    <input type="text" name="num_person" id="user" value="" disabled="disabled">
</body>