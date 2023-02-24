import 'package:flutter/material.dart';

import '../../constants.dart';

class SloganPage extends StatelessWidget {
  const SloganPage({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.start,
      crossAxisAlignment: CrossAxisAlignment.start,
      children: const [
        Text("Xin chào Dũng Lê",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 16,color: bLtitleColor),),
        SizedBox(height: 5,),
        Text("Nhiều mẫu mã đang chờ bạn thị trường thời trang",style: TextStyle(fontWeight: FontWeight.w400,fontSize: 15,color: sloganColor),),
     ],
    );
  }
}
