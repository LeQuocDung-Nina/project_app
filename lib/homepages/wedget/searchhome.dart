import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:searchfield/searchfield.dart';

import '../../constants.dart';
class SearchHome extends StatelessWidget {
  const SearchHome({Key? key}) : super(key: key);
  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.only(top: 25.0),
      child: SearchField(
        suggestions: [],
        hint: 'Tìm kiếm sản phẩm',
        searchInputDecoration:  InputDecoration(
          filled: true,
          fillColor: bgsearch,
          // prefixIcon: Icon(Icons.search),
          // prefixIconColor: blackColor,
          suffixIcon: const Icon(Icons.search),
          suffixIconColor: titlesearch,
          enabledBorder:  OutlineInputBorder(
            borderSide: const BorderSide(
              color: bgsearch,
              width: 1,
            ),
            borderRadius: BorderRadius.circular(50),
          ),
          focusedBorder: OutlineInputBorder(
            borderSide: const BorderSide(
              color: bgsearch,
              width: 2,
            ),
            borderRadius: BorderRadius.circular(50),

          )
        ),
        searchStyle: const TextStyle(fontSize: 13,fontWeight: FontWeight.w400,color: titlesearch),
      ),
    );
  }
}
