import 'package:flutter/material.dart';

import '../../constants.dart';

class OrderNotes extends StatelessWidget {
  const OrderNotes({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children:[
        const Text("Ghi chú đơn hàng",style: TextStyle(fontSize: 16,fontWeight: FontWeight.w700,color: kTextColor),),
        SizedBox(height: 20,),
        TextFormField(
          minLines: 4,
          maxLines: null,
          style: TextStyle(color: kTextColor),
          keyboardType: TextInputType.multiline,
          decoration: InputDecoration(
            filled: true,
            fillColor: bgsearch,
            alignLabelWithHint: true,
            border: OutlineInputBorder(
              borderRadius: BorderRadius.circular(10),
              borderSide: BorderSide.none,
            ),
            labelText: 'Bạn có vấn đề gì cần ghi chú vào đây',
            labelStyle: TextStyle(color: bLtitle2Color,fontSize: 13,),
          ),
        ),

      ],
    );
  }
}
