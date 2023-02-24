import 'package:flutter/material.dart';
import 'package:getwidget/getwidget.dart';

import '../constants.dart';
import 'body_waiting.dart';


class WaitingScreen extends StatefulWidget {
  const WaitingScreen({Key? key}) : super(key: key);

  @override
  State<WaitingScreen> createState() => _WaitingScreenState();
}

class _WaitingScreenState extends State<WaitingScreen> {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(),
      body: Container(
        color: Colors.white,
        padding: const EdgeInsets.symmetric(vertical: 0,horizontal: 15.0),
        child: BodyWaiting(),

      ),
      bottomNavigationBar: Container(padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 20),child: GFButton(
        onPressed: (){},
        text: "Hủy đơn hàng",
        type: GFButtonType.outline,
        fullWidthButton: true,
        color: kTextColor,
        size: 45,
        textStyle: const TextStyle(color:kTextColor,fontSize: 14,),
      ),),
    );
  }
}
