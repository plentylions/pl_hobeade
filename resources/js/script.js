document.addEventListener("afterCategoryChanged", function (e) {
  const currentCategory = e.detail.currentCategory;
  const categoryTitle = currentCategory.details[0].metaTitle ?
                            currentCategory.details[0].metaTitle :
                            currentCategory.details[0].name;

  document.title = categoryTitle;
}, false);